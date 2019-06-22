<?php
/*
    This is overrided using preference of Magento_Shipping
    module to handle shipping rule validation
 */
namespace Excellence\ShippingRules\Model\Shipping;

use Magento\Framework\App\ObjectManager;
use Magento\Quote\Model\Quote\Address\RateRequestFactory;
use Magento\Sales\Model\Order\Shipment;

class Shipping extends \Magento\Shipping\Model\Shipping
{

/**
 * Default shipping orig for requests
 *
 * @var array
 */
    protected $_orig = null;

    /**
     * Cached result
     *
     * @var \Magento\Shipping\Model\Rate\Result
     */
    protected $_result = null;

    /**
     * Part of carrier xml config path
     *
     * @var string
     */
    protected $_availabilityConfigField = 'active';

    /**
     * Core store config
     *
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $_scopeConfig;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $_storeManager;

    /**
     * @var \Magento\Shipping\Model\Config
     */
    protected $_shippingConfig;

    /**
     * @var \Magento\Shipping\Model\CarrierFactory
     */
    protected $_carrierFactory;

    /**
     * @var \Magento\Shipping\Model\Rate\ResultFactory
     */
    protected $_rateResultFactory;

    /**
     * @var \Magento\Quote\Model\Quote\Address\RateRequestFactory
     */
    protected $_shipmentRequestFactory;

    /**
     * @var \Magento\Directory\Model\RegionFactory
     */
    protected $_regionFactory;

    /**
     * @var \Magento\Framework\Math\Division
     */
    protected $mathDivision;

    /**
     * @var \Magento\CatalogInventory\Api\StockRegistryInterface
     */
    protected $stockRegistry;

    /**
     * @var RateRequestFactory
     */
    private $rateRequestFactory;

    /**
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     * @param \Magento\Shipping\Model\Config $shippingConfig
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Magento\Shipping\Model\CarrierFactory $carrierFactory
     * @param \Magento\Shipping\Model\Rate\ResultFactory $rateResultFactory
     * @param \Magento\Shipping\Model\Shipment\RequestFactory $shipmentRequestFactory
     * @param \Magento\Directory\Model\RegionFactory $regionFactory
     * @param \Magento\Framework\Math\Division $mathDivision
     * @param \Magento\CatalogInventory\Api\StockRegistryInterface $stockRegistry
     * @param RateRequestFactory $rateRequestFactory
     *
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */

    protected $_helper;

    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Shipping\Model\Config $shippingConfig,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Shipping\Model\CarrierFactory $carrierFactory,
        \Magento\Shipping\Model\Rate\ResultFactory $rateResultFactory,
        \Magento\Shipping\Model\Shipment\RequestFactory $shipmentRequestFactory,
        \Magento\Directory\Model\RegionFactory $regionFactory,
        \Magento\Framework\Math\Division $mathDivision,
        \Magento\CatalogInventory\Api\StockRegistryInterface $stockRegistry,
        RateRequestFactory $rateRequestFactory = null,
        \Excellence\ShippingRules\Helper\Data $helper
    ) {
        $this->_scopeConfig = $scopeConfig;
        $this->_shippingConfig = $shippingConfig;
        $this->_storeManager = $storeManager;
        $this->_carrierFactory = $carrierFactory;
        $this->_rateResultFactory = $rateResultFactory;
        $this->_shipmentRequestFactory = $shipmentRequestFactory;
        $this->_regionFactory = $regionFactory;
        $this->mathDivision = $mathDivision;
        $this->stockRegistry = $stockRegistry;
        $this->rateRequestFactory = $rateRequestFactory ?: ObjectManager::getInstance()->get(RateRequestFactory::class);
        $this->_helper = $helper;
    }

    public function collectCarrierRates($carrierCode, $request)
    {
        /* @var $carrier \Magento\Shipping\Model\Carrier\AbstractCarrier */
        $carrier = $this->_carrierFactory->createIfActive($carrierCode, $request->getQuoteStoreId());
        if (!$carrier) {
            return $this;
        }
        $carrier->setActiveFlag($this->_availabilityConfigField);
        $result = $carrier->checkAvailableShipCountries($request);
        if (false !== $result && !$result instanceof \Magento\Quote\Model\Quote\Address\RateResult\Error) {
            $result = $carrier->processAdditionalValidation($request);
        }

        /*
         * Result will be false if the admin set not to show the shipping module
         * if the delivery country is not within specific countries
         */
        if (false !== $result) {
            if (!$result instanceof \Magento\Quote\Model\Quote\Address\RateResult\Error) {
                if ($carrier->getConfigData('shipment_requesttype')) {
                    $packages = $this->composePackagesForCarrier($carrier, $request);
                    if (!empty($packages)) {
                        $sumResults = [];
                        foreach ($packages as $weight => $packageCount) {
                            $request->setPackageWeight($weight);
                            $result = $carrier->collectRates($request);
                            if (!$result) {
                                return $this;
                            } else {
                                $result->updateRatePrice($packageCount);
                            }
                            $sumResults[] = $result;
                        }
                        if (!empty($sumResults) && count($sumResults) > 1) {
                            $result = [];
                            foreach ($sumResults as $res) {
                                if (empty($result)) {
                                    $result = $res;
                                    continue;
                                }
                                foreach ($res->getAllRates() as $method) {
                                    foreach ($result->getAllRates() as $resultMethod) {
                                        if ($method->getMethod() == $resultMethod->getMethod()) {
                                            $resultMethod->setPrice($method->getPrice() + $resultMethod->getPrice());
                                            continue;
                                        }
                                    }
                                }
                            }
                        }
                    } else {
                        $result = $carrier->collectRates($request);
                    }
                } else {
                    $result = $carrier->collectRates($request);
                }
                if (!$result) {
                    return $this;
                }
            }
            if ($carrier->getConfigData('showmethod') == 0 && $result->getError()) {
                return $this;
            }
            // sort rates by price
            if (method_exists($result, 'sortRatesByPrice') && is_callable([$result, 'sortRatesByPrice'])) {
                $result->sortRatesByPrice();
            }
            $rowCollection = $this->_helper->getRows($carrierCode);
            /*
            if our shiping rules validated then only
            append this method to the result
             */
            if($sliderStatus=$this->_helper->isShippingRulesEnabled()){
                /*
                    isShippingRulesEnabled method verifies our 
                    shippingrules module is enabled or not 
                    from store config
                */
                if (!empty($rowCollection->getData())) {
                    $this->getResult()->append($result);
                }
            }
            else{
                $this->getResult()->append($result);
            }
        }
        return $this;
    }
}

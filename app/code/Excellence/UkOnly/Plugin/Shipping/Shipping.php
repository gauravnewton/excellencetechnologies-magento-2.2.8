<?php

namespace Excellence\UkOnly\Plugin\Shipping;
use Magento\Framework\Exception\StateException;

class Shipping extends \Magento\Shipping\Model\Shipping
{
    protected $_cart;

    protected $_productFactory;

    protected $_messageManager;

    protected $_checkoutSession;

    protected $_jsonResultFactory;

    protected $_scopeConfig;

    protected $_countryFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Checkout\Model\Cart $cart,
        \Magento\Catalog\Model\ProductFactory $productFactory,
        \Magento\Framework\Controller\Result\JsonFactory $jsonResultFactory,
        \Magento\Framework\Message\ManagerInterface $messageManager,
        \Magento\Checkout\Model\Session $checkoutSession,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Directory\Model\CountryFactory $countryFactory
    ) {
        $this->_cart = $cart;
        $this->_productFactory = $productFactory;
        $this->_messageManager = $messageManager;
        $this->_checkoutSession = $checkoutSession;
        $this->_jsonResultFactory = $jsonResultFactory;
        $this->_scopeConfig = $scopeConfig;
        $this->_countryFactory = $countryFactory;
    }


   /**
     * Allow shipping methods
     *
     * @param \Magento\Quote\Api\ShipmentEstimationInterface $subject
     * @param \Magento\Quote\Api\Data\ShippingMethodInterface[] $methods
     * @return \Magento\Quote\Api\Data\ShippingMethodInterface[] $methods
     */
    public function afterEstimateByExtendedAddress(\Magento\Quote\Api\ShipmentEstimationInterface $subject, $methods) 
    {

        $countryValidationStatus = $this->_scopeConfig->getValue('excellence_shipping_country/country_restriction_status/scope');
        $flag = false; //assume countryValidation failed

        $listOfRestrictedCountry = $this->_scopeConfig->getValue('excellence_shipping_country/restriction_group/restrictedcountry');


        $restrictedCountriesCode = explode(",",$listOfRestrictedCountry);

        $cartShippingCountryCode =  $this->_checkoutSession->getQuote()->getShippingAddress()->getCountryId();

        if (in_array($cartShippingCountryCode, $restrictedCountriesCode))
          {
            //emptying shipping methods lists...
            $methods = [];
            $country = $this->_countryFactory->create()->loadByCode($cartShippingCountryCode);
            $countryName = $country->getName();
            $message = "Shipping is restricted to ".$countryName;
            $this->_messageManager->addErrorMessage(__($message));
            throw new StateException(__($message)); 
          }
          else{
            $this->_messageManager->getMessages(true);
          }

        return $methods;
    }
}

<?php
/**
 * Copyright © 2015 Excellence . All rights reserved.
 */
namespace Excellence\ShippingRules\Helper;
class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
	/**
     * @param \Magento\Framework\App\Helper\Context $context
     */
	protected $_customerSession;

    protected $_storeManager;

	public function __construct(
		\Magento\Framework\App\Helper\Context $context,
        \Excellence\ShippingRules\Model\ShippingRulesFactory $shippingRulesFactory,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Store\Model\StoreManagerInterface $storeManager
	) {
		$this->_resultPageFactory = $resultPageFactory; 
        $this->_shippingRulesFactory = $shippingRulesFactory; 
        $this->_scopeConfig = $scopeConfig;
        $this->_customerSession = $customerSession;
        $this->_storeManager = $storeManager;

        return parent::__construct( $context);
	}
	/*
		check wheather our shipping rules module
		enbled or not from system configuration
		@return : int (1 for enabled 0 for disable)
	*/
	public function isShippingRulesEnabled()
    {
      return $this->_scopeConfig
      		->getValue('excellence_shipping_rules/shipping_rules_status/scope');
    }
	/*
		@args carriercode
		return the whole filtered row collection on the basis of provided carrier code
	*/
	public function getRows($carrierCode){
		
		$now = new \DateTime();

		$rows = $this->_shippingRulesFactory->create()
						->getCollection()->addFieldToFilter('status',array('eq' => 1)
						)->addFieldToFilter('shipping_method',array('like' => '%'.$carrierCode.'%')
						)->addFieldToFilter('store_view',array('like' => '%'.$this->getCurrentStoreId().'%')
						)->addFieldToFilter('customer_group',array('like' => '%'.$this->getCurrentCustomerGroupId().'%')
						)->addFieldToFilter('from_date',array('lteq' => $now->format('Y-m-d H:i:s'))
						)->addFieldToFilter('to_date',array('gteq' => $now->format('Y-m-d H:i:s'))
						);
        return $rows;        
    }
    /* 
    	*reutrn current store ids
    	*@return type int
    */
    public function getCurrentStoreId(){
    	$current_store_id = $this->_storeManager->getStore()->getId();
    	return $current_store_id;
    }
    /* 
    	*reutrn current customer id
    	*@return type int
    */
    public function getCurrentCustomerGroupId(){
    	$current_customer_group_id = $this->_customerSession->getCustomer()->getGroupId();
    	return $current_customer_group_id;
    }
}
<?php
namespace Excellence\ExcellenceSlider\Helper;
class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
     public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Excellence\ExcellenceSlider\Model\SliderFactory $sliderFactory,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    )
    {
        $this->_resultPageFactory = $resultPageFactory; 
        $this->_sliderFactory = $sliderFactory; 
        $this->_scopeConfig = $scopeConfig;
        return parent::__construct( $context);
    }
    public function isSliderEnabled()
    {
      
      return $this->_scopeConfig->getValue('excellence/active_display/scope');
    }

    public function getSliderUrl(){
    	$row = $this->_sliderFactory->create()
                    ->getCollection()->addFieldToFilter('status', array('eq' => 1));
        return $row;
        
    }
}
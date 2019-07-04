<?php
namespace Excellence\Slider\Block\Widget;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Widget\Block\BlockInterface;
use Excellence\Slider\Model\SlidesFactory;
use Excellence\Slider\Model\SliderpagesFactory; 

class SliderWidget extends Template implements BlockInterface
{    
    protected $_sliderdata;
    protected $_scopeConfigObject;
    protected $_template = "widget/slider-widget.phtml";

    public function __construct(
        Context $context,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfigObject,
        SlidesFactory $sliderCollections,
        SliderpagesFactory $sliderpagesCollections
    ) {
        $this->_sliderpagesCollections = $sliderpagesCollections;
        $this->_sliderCollections = $sliderCollections;
        $this->_scopeConfigObject = $scopeConfigObject;
        parent::__construct($context);
    }
    public function getSliderStretchInfo($sliderId){
        $sliderInfoDetails = $this->_sliderpagesCollections->create()->getCollection()->addFieldToFilter('id', array('eq' => $sliderId));
        return $sliderInfoDetails;

    }
    public function getSliderDetails($sliderLogCollections){   
       $sliderInfo = $this->_sliderCollections->create()->getCollection()->addFieldToFilter('slider_name', array('eq' => $sliderLogCollections));
       return $sliderInfo;
    }
    public function getSliderType(){
        if(!($this->_scopeConfigObject->getValue('slider/slider/enable'))){
            return;
        }
        $sliderInfo['sliderType'] = $this->_scopeConfigObject->getValue('slider/slider/select_slider');
        $sliderSpeed = $this->_scopeConfigObject->getValue('slider/slider/select_speed');
        $sliderInfo['sliderSpeed'] = ($sliderSpeed * 1000);
        $sliderInfo['fade'] = $this->_scopeConfigObject->getValue('slider/slider/select_fade');
        $sliderInfo['pauseonhover'] = $this->_scopeConfigObject->getValue('slider/slider/select_pauseonhover');
        $sliderInfo['loop'] = $this->_scopeConfigObject->getValue('slider/slider/select_loop');
        $sliderInfo['dots'] = $this->_scopeConfigObject->getValue('slider/slider/select_dots');
        $sliderInfo['imagecounts'] = $this->_scopeConfigObject->getValue('slider/slider/select_image_numbers');
        $sliderInfo['autoplay'] = $this->_scopeConfigObject->getValue('slider/slider/select_autoplay');
        return $sliderInfo;
    }
}
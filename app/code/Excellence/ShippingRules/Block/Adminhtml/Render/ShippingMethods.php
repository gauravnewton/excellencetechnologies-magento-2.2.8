<?php
namespace Excellence\ShippingRules\Block\Adminhtml\Render;

use Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer;
use Magento\Framework\DataObject;
 
class ShippingMethods extends AbstractRenderer
{
    protected $_shippingMethods;
    protected $_repository;
    public function __construct(
        \Magento\Backend\Block\Context $context,
        \Excellence\ShippingRules\Model\Adminhtml\GetAllowedShippingMethods $shippingMethods,

        \Magento\Sales\Api\ShipmentRepositoryInterface $repository,
        array $data = array()
    ){
        parent::__construct($context, $data);
        $this->_repository = $repository;
        $this->_shippingMethods = $shippingMethods;
    }
    
    public function render(DataObject $row)
    {       
        $renderResult = "<div>";
        $rowCollection = $row->getData();
        $shippingId = $rowCollection['shipping_method'];        
        $allShipping = $this->_shippingMethods->getAllCarriers();        
        $explodedShippingIds = explode(",", $shippingId);        
        foreach ($explodedShippingIds as $id) {
           $renderResult .= $allShipping[$id]['label']."</div><div>";
        }
        return $renderResult;
    }   
}
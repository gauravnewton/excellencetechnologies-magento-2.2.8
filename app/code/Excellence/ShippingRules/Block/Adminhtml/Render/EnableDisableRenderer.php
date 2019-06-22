<?php
namespace Excellence\ShippingRules\Block\Adminhtml\Render;

use Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer;
use Magento\Framework\DataObject;
 
class EnableDisableRenderer extends AbstractRenderer
{
    protected $_status;
    public function __construct(
        \Magento\Backend\Block\Context $context,
        \Excellence\ShippingRules\Model\Adminhtml\StatusModel $Status,
        array $data = array()
    ){
        parent::__construct($context, $data);
        $this->_status = $Status;
    }
    
    public function render(DataObject $row)
    {   
        $rowCollection = $row->getData();
        $statusId = $rowCollection['status'];
        $getStatus = $this->_status->optionArray();
        return $getStatus[$statusId];
    }   
}
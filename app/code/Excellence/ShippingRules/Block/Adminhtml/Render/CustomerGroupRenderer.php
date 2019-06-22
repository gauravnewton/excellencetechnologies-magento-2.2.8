<?php
namespace Excellence\ShippingRules\Block\Adminhtml\Render;

use Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer;
use Magento\Framework\DataObject;
 
class CustomerGroupRenderer extends AbstractRenderer
{
    protected $_group;
    protected $_customerGroupColl;

    public function __construct(
        \Magento\Backend\Block\Context $context,
        \Magento\Customer\Model\ResourceModel\Group\Collection $Group,
        \Magento\Customer\Model\ResourceModel\Group\Collection $customerGroupColl,
        array $data = array()
    ) {
        parent::__construct($context, $data);
        $this->_group = $Group;
        $this->_customerGroupColl = $customerGroupColl;
    }
    
    public function render(DataObject $row)
    {
        $renderResult = "<div>";
        $rowCollection = $row->getData();
        $groupId = $rowCollection['customer_group'];
        $allGroups = $this->_customerGroupColl->toOptionArray();
        $explodedGroupIds = explode(",", $groupId);
        foreach ($explodedGroupIds as $id) {
           $renderResult .= $allGroups[$id]['label']."</div><div>";
        }
        return $renderResult;
    }   
}
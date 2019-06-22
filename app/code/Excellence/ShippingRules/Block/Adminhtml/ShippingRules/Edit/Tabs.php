<?php
namespace Excellence\ShippingRules\Block\Adminhtml\ShippingRules\Edit;

class Tabs extends \Magento\Backend\Block\Widget\Tabs
{
    protected function _construct()
    {
		parent::_construct();
        $this->setId('checkmodule_shippingrules_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Excellence ShippingRules'));
    }
}
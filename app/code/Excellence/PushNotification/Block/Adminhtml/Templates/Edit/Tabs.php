<?php
namespace Excellence\PushNotification\Block\Adminhtml\Templates\Edit;

class Tabs extends \Magento\Backend\Block\Widget\Tabs
{
    protected function _construct()
    {
        parent::_construct();
        $this->setId('checkmodule_templates_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Templates Information'));
    }
}
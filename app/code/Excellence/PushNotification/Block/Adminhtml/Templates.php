<?php
namespace Excellence\PushNotification\Block\Adminhtml;
class Templates extends \Magento\Backend\Block\Widget\Grid\Container
{
    /**
     * Constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_controller = 'adminhtml_templates';/*block grid.php directory*/
        $this->_blockGroup = 'Excellence_PushNotification';
        $this->_headerText = __('Templates');
        $this->_addButtonLabel = __('Add New Template'); 
        parent::_construct();
    }
}

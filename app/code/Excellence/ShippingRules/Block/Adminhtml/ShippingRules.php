<?php
namespace Excellence\ShippingRules\Block\Adminhtml;
class ShippingRules extends \Magento\Backend\Block\Widget\Grid\Container
{
    /**
     * Constructor
     *
     * @return void
     */
    protected function _construct()
    {
		$this->_controller = 'adminhtml_shippingRules';/*block grid.php directory*/
        $this->_blockGroup = 'Excellence_ShippingRules';
        $this->_headerText = __('ShippingRules');
        $this->_addButtonLabel = __('Add New Shipping Rule'); 
        parent::_construct();
    }
}

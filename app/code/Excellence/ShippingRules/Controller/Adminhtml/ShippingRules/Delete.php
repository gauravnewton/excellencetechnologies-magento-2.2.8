<?php
namespace Excellence\ShippingRules\Controller\Adminhtml\ShippingRules;

class Delete extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    public function execute()
    {
		$id = $this->getRequest()->getParam('id');
		try {
				$banner = $this->_objectManager->get('Excellence\ShippingRules\Model\ShippingRules')->load($id);
				$banner->delete();
                $this->messageManager->addSuccess(
                    __('Shipping Rule Deleted successfully !')
                );
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
            }
	    $this->_redirect('*/*/');
    }
}

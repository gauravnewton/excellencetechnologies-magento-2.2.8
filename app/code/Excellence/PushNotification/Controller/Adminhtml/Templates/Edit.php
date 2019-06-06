<?php
namespace Excellence\PushNotification\Controller\Adminhtml\Templates;

class Edit extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    public function execute()
    {
    // 1. Get ID and create model
    $id = $this->getRequest()->getParam('id');

    $model = $this->_objectManager->create('Excellence\PushNotification\Model\Templates');

    $registryObject = $this->_objectManager->get('Magento\Framework\Registry');

    // 2. Initial checking
    if ($id) {
        $model->load($id);
        if (!$model->getId()) {
            $this->messageManager->addError(__('This template no longer exists.'));
            $this->_redirect('*/*/');
            return;
        }
        }
        // 3. Set entered data if was error when we do save
        $data = $this->_objectManager->get('Magento\Backend\Model\Session')->getFormData(true);
        if (!empty($data)) {
            $model->setData($data);
        }
        $registryObject->register('pushnotification_templates', $model);
        $this->_view->loadLayout();
        $this->_view->getLayout()->initMessages();
        $this->_view->renderLayout();
    }
}

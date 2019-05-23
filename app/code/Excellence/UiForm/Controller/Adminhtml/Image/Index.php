<?php

namespace Excellence\UiForm\Controller\Adminhtml\Image;

use Excellence\UiForm\Controller\Adminhtml\Image;

class Index extends Image
{
    /**
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Excellence_UiForm::image');
        $resultPage->getConfig()->getTitle()->prepend(__('Images'));
        $resultPage->addBreadcrumb(__('Images'), __('Images'));
        return $resultPage;
    }
}

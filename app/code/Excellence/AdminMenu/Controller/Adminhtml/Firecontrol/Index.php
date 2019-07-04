<?php
namespace Excellence\AdminMenu\Controller\Adminhtml\Firecontrol;
 
 
class Index extends \Magento\Backend\App\Action
{
    
    protected $resultPageFactory = false;
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Excellence_AdminMenu::admin_menu');
        $resultPage->addBreadcrumb(__('Menu'), __('Menu'));
        $resultPage->addBreadcrumb(__('Slides'), __('Slides'));
        $resultPage->getConfig()->getTitle()->prepend(__('Admin Menu'));
        return $resultPage;
    }
}
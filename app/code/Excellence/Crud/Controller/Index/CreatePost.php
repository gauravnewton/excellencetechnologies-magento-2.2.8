<?php
namespace Excellence\Crud\Controller\Index;

class CreatePost extends \Magento\Framework\App\Action\Action
{
    protected $resultPageFactory;
    protected $coreRegistry;
    protected $crudFactory;

    public function __construct(
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Excellence\Crud\Model\CrudFactory $crudFactory) {
        $this->_coreRegistry = $coreRegistry;
        $this->resultPageFactory = $resultPageFactory;
        $this->crudFactory = $crudFactory;
        return parent::__construct($context);
    }

    public function execute()
    {
        $registration = $this->crudFactory->create();
        $data = $this->getRequest()->getPostValue();
        $registration->setData($data);
        $registration->save();
        $this->_redirect('crud/index/create');
        $this->messageManager->addSuccess(__('Your Data saved Successfully.'));
    }
}

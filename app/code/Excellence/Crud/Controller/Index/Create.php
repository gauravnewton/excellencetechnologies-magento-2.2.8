<?php
namespace Excellence\Crud\Controller\Index;

class Create extends \Magento\Framework\App\Action\Action
{
    protected $resultPageFactory;
    protected $coreRegistry;

    public function __construct(
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory) {
        $this->_coreRegistry = $coreRegistry;
        $this->resultPageFactory = $resultPageFactory;
        return parent::__construct($context);
    }

    public function execute()
    {
        return $this->resultPageFactory->create();

    }
}

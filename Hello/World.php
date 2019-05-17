<?php
namespace Excellence\Hello\Controller\Hello;
use magento\Framework\Controller\ResultFactory;
 
 
class World extends \Magento\Framework\App\Action\Action
{
    protected $resultPageFactory;
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory)
    {
        $this->resultPageFactory = $resultPageFactory;       
        $this->registry = $registry;
        return parent::__construct($context);
    }
     
    public function execute()
    {
        //creting registery variable
        $this->registry->register('test_var','same variable data using registry');

        // $resultRedirect = $this->resultFactory->create(Resultfactory::TYPE_REDIRECT);
        // $resultRedirect->setUrl($this->_redirect->getRefererUrl());
        // return $resultRedirect;

        return $this->resultPageFactory->create(); 
        //return $this->resultRedirectFactory->create()->setPath('excellence/index/add/', ['_current' => true]);
    } 
}
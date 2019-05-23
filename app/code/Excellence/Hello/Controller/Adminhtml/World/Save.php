<?php
 
namespace Excellence\Hello\Controller\Adminhtml\World;
 
class Save extends \Magento\Backend\App\Action
{
    
    protected $resultPageFactory = false;
    public function __construct(

        // \Magento\Framework\Stdlib\DateTime\DateTime $date,
        \Magento\Backend\App\Action\Context $context,
        \Excellence\Hello\Model\TestFactory $testFactory,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {

        $this->_testFactory = $testFactory;
    // $this->date = $date;
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }
    public function execute()
    {

        $test = $this->_testFactory->create();
        
        $d = $this->getRequest()->getPostValue();
        
        $resultPage = $this->resultPageFactory->create();


        $d = $d['fieldset'];
        $t['email'] = $d['email'];
        $t['thumbnail'] = $d['thumbnail'];
                // echo "<pre>";
                // print_r($d);
        $test->setData($t);
        $test->save();


        $this->messageManager->addSuccess(__("Data Saved Successfully !"));


        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath('hello/world/new');
        return $resultRedirect;
    }
}
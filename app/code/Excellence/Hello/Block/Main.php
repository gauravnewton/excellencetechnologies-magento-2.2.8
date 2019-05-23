<?php
namespace Excellence\Hello\Block\Adminhtml\Form;
  
class Main extends \Magento\Framework\View\Element\Template
{   
    protected $_testFactory;
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Excellence\Hello\Model\TestFactory $testFactory
    )
    {
        $this->_testFactory = $testFactory;
        $this->registry = $registry;
        parent::__construct($context);
    }
    protected function _prepareLayout()
    {
        //creating a factory to load db..
        //$test = $this->_testFactory->create();
        // $test->setTitle('Test Title');
        // $test->save();
        // $this->setTestModel($test);

        //  $test->load(1); 
        //  echo "<pre>"; 
        //  print_r($test->getTitle());
        //  die;
 
        //  $test->delete(1);


        // $test->load(10);
        // $test->setTitle('Updated Title');
        // $test->save();
        // $this->setTestModel($test);

        // //accessing registry variable 
        // print_r($this->registry->registry('test_var'));
    } 
    public function grabbingData(){
        $test = $this->_testFactory->create()->getCollection();
         echo "<pre>";
         print_r($test->getData());
         die("dkbu");
       return $test->getData();
        

    }
}
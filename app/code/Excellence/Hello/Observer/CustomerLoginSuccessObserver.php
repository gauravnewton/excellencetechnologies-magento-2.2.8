<?php

namespace Excellence\Hello\Observer;

use Magento\Framework\Event\ObserverInterface;

class CustomerLoginSuccessObserver implements ObserverInterface
{

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Excellence\Hello\Model\TestFactory $testFactory,
        \Magento\Framework\Stdlib\DateTime\DateTime $date
    )
    {
        $this->date = $date;
        $this->_testFactory = $testFactory;
        
    }
    

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        //echo "Customer LoggedIn";

        $test = $this->_testFactory->create();

        $customer = $observer->getEvent()->getCustomer();
        // echo $customer->getName(); //Get customer name
        $email_id =  $customer->getEmail();
        $row = $this->_testFactory->create()->getCollection()->addFieldToFilter('email', array('eq' => $email_id));
        

        if(count($row)>0)
        {
            //row found with associated email id updating existing row..
            $id = $row->getFirstItem()->getTestId();

            $test->load($id);
            
            $date = $this->date->gmtDate(); //in 24 hours format
            $test->setLoginTime($date);
            $test->save();
            
            
        }
        else{
            //no row found associated with this email-id 
            //inserting new row ...
            
            $test->setEmail($email_id);
            $test->save();
        
        }
    }
}

<?php
    namespace Excellence\Hello\Model\Rewrite\Customer;
  
    class Customer extends \Magento\Customer\Model\Customer
    {
        public function loadByEmail($customerEmail)
        {
 
            //echo $customerEmail.'<br/>'; exit;
            // Do your stuff here
             return parent::loadByEmail($customerEmail);
        }
  
    }
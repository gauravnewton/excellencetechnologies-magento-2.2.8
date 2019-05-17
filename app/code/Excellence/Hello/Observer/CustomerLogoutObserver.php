<?php

namespace Excellence\Hello\Observer;

use Magento\Framework\Event\ObserverInterface;

class CustomerLogoutObserver implements ObserverInterface
{
    public function __construct(
        \Magento\Framework\
    )
    {
            
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        //echo "Customer LoggedIn";
        $customer = $observer->getEvent()->getCustomer();
        echo $customer->getName(); //Get customer name
        die("logout");
    }
}

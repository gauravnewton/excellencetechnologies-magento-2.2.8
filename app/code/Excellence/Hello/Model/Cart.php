<?php
 
namespace Excellence\Hello\Model;
 
class Cart
{
public function beforeAddProduct(\Magento\Checkout\Model\Cart $cart, $productInfo, $requestInfo = null)
    {
        $requestInfo['qty'] = 5; // set quantity to 5
        return array(
        $productInfo,
        $requestInfo
        );
    }


    public function aroundAddProduct(\Magento\Checkout\Model\Cart $cart, \Closure $proceed, $productInfo, $requestInfo = null)
    {
        $requestInfo['qty'] = 5; // setting quantity to 5
        $result             = $proceed($productInfo, $requestInfo);

        // change result here

        return $result;
    }
}
?>
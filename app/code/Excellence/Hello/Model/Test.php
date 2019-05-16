<?php
namespace Excellence\Hello\Model;
class Test extends \Magento\Framework\Model\AbstractModel 
{
    const CACHE_TAG = 'excellence_hello_test';
 
    protected function _construct()
    {
        $this->_init('Excellence\Hello\Model\ResourceModel\Test');
    }
 
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
}
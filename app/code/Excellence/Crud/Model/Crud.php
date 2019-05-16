<?php
namespace Excellence\Crud\Model;

class Crud extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'crud';

    protected function _construct()
    {
        $this->_init('Excellence\Crud\Model\ResourceModel\Crud');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
}
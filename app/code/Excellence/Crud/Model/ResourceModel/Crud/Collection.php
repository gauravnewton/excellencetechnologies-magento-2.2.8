<?php
namespace Excellence\Crud\Model\ResourceModel\Crud;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Excellence\Crud\Model\Crud', 'Excellence\Crud\Model\ResourceModel\Crud');
    }
}

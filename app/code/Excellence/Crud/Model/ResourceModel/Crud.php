<?php
namespace Excellence\Crud\Model\ResourceModel;

class Crud extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('crud', 'crud_id');
    }
}
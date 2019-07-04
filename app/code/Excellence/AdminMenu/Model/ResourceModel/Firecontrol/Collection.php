<?php
namespace Excellence\AdminMenu\Model\ResourceModel\Firecontrol;
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
	protected $_idFieldName = 'id';

    protected function _construct()
    {
        $this->_init('Excellence\AdminMenu\Model\Firecontrol','Excellence\AdminMenu\Model\ResourceModel\Firecontrol');
    }
}

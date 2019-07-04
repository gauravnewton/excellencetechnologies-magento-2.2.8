<?php
namespace Excellence\AdminMenu\Model\ResourceModel;
class Firecontrol extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('excellence_adminmenu_firecontrol','id');
    }
}

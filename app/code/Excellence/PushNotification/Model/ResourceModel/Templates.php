<?php
/**
 * Copyright © 2015 Excellence. All rights reserved.
 */
namespace Excellence\PushNotification\Model\ResourceModel;

/**
 * Templates resource
 */
class Templates extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Initialize resource
     *
     * @return void
     */
    public function _construct()
    {
        $this->_init('pushnotification_templates', 'id');
    }
}

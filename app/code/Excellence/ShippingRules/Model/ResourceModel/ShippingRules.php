<?php
/**
 * Copyright © 2015 Excellence. All rights reserved.
 */
namespace Excellence\ShippingRules\Model\ResourceModel;

/**
 * ShippingRules resource
 */
class ShippingRules extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Initialize resource
     *
     * @return void
     */
    public function _construct()
    {
        $this->_init('shippingrules_shippingrules', 'id');
    }

  
}

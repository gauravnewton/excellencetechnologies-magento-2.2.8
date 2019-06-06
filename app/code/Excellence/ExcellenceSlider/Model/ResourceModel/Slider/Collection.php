<?php
namespace Excellence\ExcellenceSlider\Model\ResourceModel\Slider;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * Initialize resource collection
     *
     * @return void
     */
    public function _construct()
    {
        $this->_init('Excellence\ExcellenceSlider\Model\Slider', 'Excellence\ExcellenceSlider\Model\ResourceModel\Slider');
    }
}

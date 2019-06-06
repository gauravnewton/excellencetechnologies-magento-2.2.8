<?php
namespace Excellence\ExcellenceSlider\Model;

use Magento\Framework\Exception\SliderException;

/**
 * Slidertab slider model
 */
class Slider extends \Magento\Framework\Model\AbstractModel
{

    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        array $data = []
    ) {
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    

    /**
     * @return void
     */
    public function _construct()
    {
        $this->_init('Excellence\ExcellenceSlider\Model\ResourceModel\Slider');
    }

}
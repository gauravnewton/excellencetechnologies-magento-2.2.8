<?php
namespace Excellence\Crud\Block;

class Create extends \Magento\Framework\View\Element\Template
{
    protected $crudFactory;

    public $_coreRegistry;

    public function __construct(\Magento\Framework\Registry $coreRegistry,
        \Magento\Framework\View\Element\Template\Context $context,
        \Excellence\Crud\Model\CrudFactory $crudFactory
    ) {
        $this->_coreRegistry = $coreRegistry;
        $this->crudFactory = $crudFactory;
        parent::__construct($context);

    }
    public function getUrl($route = '', $params = [])
    {
        return $this->_urlBuilder->getUrl($route, $params);
    }
    public function getUserData()
    {

    }
}

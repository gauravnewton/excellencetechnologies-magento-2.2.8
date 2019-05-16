<?php
namespace Excellence\Crud\Block;

class Show extends \Magento\Framework\View\Element\Template
{
    protected $crudFactory;

    public $_coreRegistry;

    public function __construct(\Magento\Framework\Registry $coreRegistry,
        \Magento\Framework\View\Element\Template\Context $context,
        \Excellence\Crud\Model\CrudFactory $dataFactory
    ) {
        $this->_coreRegistry = $coreRegistry;
        $this->crudFactory = $dataFactory;
        parent::__construct($context);
    }
    public function getUserData()
    {
        //get values of current page. if not the param value then it will set to 1
        $page = ($this->getRequest()->getParam('p')) ? $this->getRequest()->getParam('p') : 1;
        //get values of current limit. if not the param value then it will set to 1
        $pageSize = ($this->getRequest()->getParam('limit')) ? $this->getRequest()->getParam('limit') : 1;
        $collection = $this->crudFactory->create();
        $collection = $collection->getCollection();
        $collection->setPageSize($pageSize);
        $collection->setCurPage($page);
        return $collection;
    }
    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        $this->pageConfig->getTitle()->set(__('Employees Records'));

        if ($this->getUserData()) {
            $pager = $this->getLayout()->createBlock(
                'Magento\Theme\Block\Html\Pager',
                'fme.news.pager'
            )->setAvailableLimit(array(3 => 3, 6 => 6, 10 => 10))->setShowPerPage(true)->setCollection(
                $this->getUserData()
            );
            $this->setChild('pager', $pager);
            $this->getUserData()->load();
        }
        return $this;
    }
    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }
}

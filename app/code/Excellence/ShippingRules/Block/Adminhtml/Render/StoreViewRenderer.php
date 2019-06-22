<?php
namespace Excellence\ShippingRules\Block\Adminhtml\Render;

use Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer;
use Magento\Framework\DataObject;
 
class StoreViewRenderer extends AbstractRenderer
{
    protected $_storeView;

    public function __construct(
        \Magento\Backend\Block\Context $context,
        \Magento\Store\Model\System\Store $systemStore,
        array $data = array()
    ){
        parent::__construct($context, $data);
        $this->_systemStore = $systemStore;
    }
    
    public function render(DataObject $row)
    {       
        $renderResult = "<div>";
        $rowCollection = $row->getData();
        $storeId = $rowCollection['store_view'];        
        $allStore = $this->_systemStore->getStoreValuesForForm(false, true);        
        $explodedStoreIds = explode(",", $storeId);        
        foreach ($explodedStoreIds as $id) {
           $renderResult .= $allStore[$id]['label']."</div><div>";
        }
        return $renderResult;
    }
}
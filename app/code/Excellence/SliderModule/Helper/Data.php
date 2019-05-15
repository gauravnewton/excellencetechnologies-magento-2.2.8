<?php
namespace Excellence\SliderModule\Helper;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
     /** 
     * Product collection
     *   
     * @var \Magento\Catalog\Model\ResourceModel\Product\Collection
     */  
    protected $collectionFactory;

    /** 
     * Construct
     *   
     * @param CollectionFactory $collectionFactory
     */  
    public function __construct(
    CollectionFactory $collectionFactory
) { 
        $this->collectionFactory = $collectionFactory;
    }   

    public function getProductCollection()
    {   
        // Use factory to create a new product collection
        
        $productCollection = $this->collectionFactory->create();
        /** Apply filters here */
        //$productCollection->setPageSize(10)->load();
        $productCollection->addAttributeToSelect('*')->addCategoriesFilter(['in' => 10])->load();
        //$productCollection->setPage(0,2);
        return $productCollection;

        
    }  
}
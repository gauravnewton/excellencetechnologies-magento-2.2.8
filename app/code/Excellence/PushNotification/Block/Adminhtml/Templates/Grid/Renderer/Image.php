<?php
namespace Excellence\PushNotification\Block\Adminhtml\Templates\Grid\Renderer;

class Image extends \Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer
{
    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $_storeManager;

    public function __construct(
        \Magento\Backend\Block\Context $context,
        \Magento\Store\Model\StoreManagerInterface $storeManager,      
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_storeManager = $storeManager;        
    }

    public function render(\Magento\Framework\DataObject $row)
    {
        $img;
        $mediaDirectory = $this->_storeManager->getStore()->getBaseUrl(
            \Magento\Framework\UrlInterface::URL_TYPE_MEDIA
        );
        if($this->_getValue($row)!=''):
            $imageUrl = $mediaDirectory.$this->_getValue($row);
            $img='<img src="'.$imageUrl.'" width="50" height="50"/>';
        else:
            $img='<img src="'.$mediaDirectory.'Modulename/no-img.jpg'.'" width="50" height="50"/>';
        endif;
        return $img;
    }
}
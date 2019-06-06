<?php
namespace Excellence\ExcellenceSlider\Block\Adminhtml\Slider\Edit\Tab;
class AllSlides extends \Magento\Backend\Block\Widget\Form\Generic implements \Magento\Backend\Block\Widget\Tab\TabInterface
{
  protected $_systemStore;

   public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Store\Model\System\Store $systemStore,
        array $data = array()
    ) {
        $this->_systemStore = $systemStore;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    protected function _prepareForm()
    {
		$model = $this->_coreRegistry
                      ->registry('excellenceslider_slider');
		$isElementDisabled = false;
        $form = $this->_formFactory->create();

        $form->setHtmlIdPrefix('page_');

        $fieldset = $form->addFieldset('base_fieldset', array('legend' => __('All Slides')));

        if ($model->getId()) {
            $fieldset->addField('id', 'hidden', array('name' => 'id'));
        }

		$fieldset->addField(
            'path',
            'image',
            array(
                'name' => 'path',
                'label' => __('image'),
                'title' => __('image'),
                'required' => true,
                'enctype'   => 'multipart/form-data',
            )
        );

        $fieldset->addField(
            'status',
            'select',
            [
                'name' => 'status',
                'label' => __('Enable in slider'),
                'id' => 'status',
                'title' => __('Status'),
                'required' => true,
                'options' => array('Yes','No'),
                'values'=> array(1=>'Yes', 0=>'No')
            ]
        );
		if (!$model->getId()) {
            $model->setData('status', $isElementDisabled ? '2' : '1');
        }

        $form->setValues($model->getData());
        $this->setForm($form);

        return parent::_prepareForm();   
    }

    public function getTabLabel()
    {
        return __('All Slides');
    }

    public function getTabTitle()
    {
        return __('All Slides');
    }

   public function canShowTab()
    {
        return true;
    }

    public function isHidden()
    {
        return false;
    }

    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }
}

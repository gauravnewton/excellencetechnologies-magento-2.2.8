<?php
namespace Excellence\PushNotification\Block\Adminhtml\Templates\Edit\Tab;
class NewTemplate extends \Magento\Backend\Block\Widget\Form\Generic implements \Magento\Backend\Block\Widget\Tab\TabInterface
{
    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magento\Store\Model\System\Store $systemStore
     * @param array $data
     */
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

    /**
     * Prepare form
     *
     * @return $this
     */
    protected function _prepareForm()
    {
        /* @var $model \Magento\Cms\Model\Page */
        $model = $this->_coreRegistry->registry('pushnotification_templates');
        $isElementDisabled = false;
        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();

        $form->setHtmlIdPrefix('page_');

        $fieldset = $form->addFieldset('base_fieldset', array('legend' => __('New Template')));

        if ($model->getId()) {
            $fieldset->addField('id', 'hidden', array('name' => 'id'));
        }

        $fieldset->addField(
            'name',
            'text',
            array(
                'name' => 'name',
                'label' => __('Title'),
                'title' => __('title'),
                'required' => true,
            )
        );
        $fieldset->addField(
            'subject',
            'text',
            array(
                'name' => 'subject',
                'label' => __('Subject'),
                'title' => __('subject'),
                'required' => true,
                'placeholder' => __('Character limit : 30'),
                'maxlength' => 30,
                'note' => __('Maximum Character length is <strong>30</strong>.')
            )
        );
        $fieldset->addField(
            'body',
            'textarea',
            array(
                'name' => 'body',
                'label' => __('Body'),
                'title' => __('body'),
                'placeholder' => __('Character limit : 90'),
                'maxlength' => 90,
                'note' => __('Maximum Character length is <strong>90</strong>.')
            )
        );
        $fieldset->addField(
            'destination_url',
            'text',
            array(
                'name' => 'destination_url',
                'label' => __('Destination URL'),
                'title' => __('destination url'),
                /*'required' => true,*/
            )
        );
        $fieldset->addField(
            'icon',
            'image',
            array(
                'name' => 'icon',
                'label' => __('Icon'),
                'title' => __('icon'),
                'note' => 'Allow image type: jpg, jpeg, gif, png',
            )
        );
        /*{{CedAddFormField}}*/

        if (!$model->getId()) {
            $model->setData('status', $isElementDisabled ? '2' : '1');
        }

        $form->setValues($model->getData());
        $this->setForm($form);

        return parent::_prepareForm();   
    }

    /**
     * Prepare label for tab
     *
     * @return string
     */
    public function getTabLabel()
    {
        return __('New Template');
    }

    /**
     * Prepare title for tab
     *
     * @return string
     */
    public function getTabTitle()
    {
        return __('New Template');
    }

    /**
     * {@inheritdoc}
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isHidden()
    {
        return false;
    }

    /**
     * Check permission for passed action
     *
     * @param string $resourceId
     * @return bool
     */
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }
}

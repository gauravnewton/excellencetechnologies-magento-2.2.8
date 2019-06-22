<?php
namespace Excellence\ShippingRules\Block\Adminhtml\ShippingRules\Edit\Tab;
class Status extends \Magento\Backend\Block\Widget\Form\Generic implements \Magento\Backend\Block\Widget\Tab\TabInterface
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

    protected $_customerGroupColl;

    protected $_status;

    protected $_allowedMethods;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Store\Model\System\Store $systemStore,
        \Magento\Customer\Model\ResourceModel\Group\Collection $customerGroupColl,
        \Excellence\ShippingRules\Model\Adminhtml\StatusModel $status,
        \Excellence\ShippingRules\Model\Adminhtml\GetAllowedShippingMethods $allowedMethods,
        array $data = array()
    ) {
        $this->_allowedMethods = $allowedMethods;
        $this->_customerGroupColl = $customerGroupColl;
        $this->_status = $status;
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
        $model = $this->_coreRegistry->registry('shippingrules_shippingrules');
		$isElementDisabled = false;
        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();

        $form->setHtmlIdPrefix('page_');

        $fieldset = $form->addFieldset('base_fieldset', array('legend' => __('New Shipping Rule')));

        if ($model->getId()) {
            $fieldset->addField('id', 'hidden', array('name' => 'id'));
        }

		$fieldset->addField(
            'name',
            'text',
            array(
                'name' => 'name',
                'label' => __('Name'),
                'title' => __('Name'),
                'required' => true,
            )
        );
		$fieldset->addField(
            'status',
            'select',
            array(
                'name' => 'status',
                'label' => __('Status'),
                'title' => __('Status'),
                'values' => $this->_status->toOptionArray(),
                'required' => true,
            )
        );
        $fieldset->addField(
            'shipping_method',
            'multiselect',
            array(
                'name' => 'shipping_method',
                'label' => __('Shipping Method'),
                'title' => __('Shipping Method'),
                'values' =>$this->_allowedMethods->getAllCarriers(),
            )
        );
        $fieldset->addField(
            'from_date',
            'date',
            array(
                'name' => 'from_date',
                'label' => __('From Date'),
                'date_format' => 'yyyy-MM-dd',
                'title' => __('From Date'),
            )
        );
        $fieldset->addField(
            'to_date',
            'date',
            array(
                'name' => 'to_date',
                'label' => __('To Date'),
                'date_format' => 'yyyy-MM-dd',
                'title' => __('To Date'),
            )
        );
        $fieldset->addField(
            'store_view',
            'multiselect',
            array(
                'name' => 'store_view',
                'label' => __('Store View'),
                'title' => __('Store View'),
                'required' => true,
                'values'   => $this->_systemStore->getStoreValuesForForm(false, true),
            )
        );
        $fieldset->addField(
            'customer_group',
            'multiselect',
            array(
                'name' => 'customer_group',
                'label' => __('Customer Group'),
                'title' => __('Customer Group'),
                'values' => $this->_customerGroupColl->toOptionArray(),
            )
        );

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
        return __('New Shipping Rule');
    }

    /**
     * Prepare title for tab
     *
     * @return string
     */
    public function getTabTitle()
    {
        return __('New Shipping Rule');
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

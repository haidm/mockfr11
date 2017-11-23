<?php

class SM_Filter_Block_Adminhtml_Filter_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    /**
     *
     * return Mage_Adminhtml_Block_Widget_Form
     */
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form(
            array(
                'id' => 'edit_form',
                'action' => $this->getUrl('*/*/save'),
                'method' => 'post',
                'enctype' => 'multipart/form-data',
            ));
        $this->setForm($form);
        $model = Mage::registry('filter_model');
        $fieldset = $form->addFieldset('filter_form',
            array('legend' => 'Filter infomation'));

        $fieldset->addField('attribute_code', 'text', array(
            'label' => Mage::helper('core')->__('Attribute Code'),
            'required' => false,
            'name' => 'attribute_code',
            'disabled' => 'disabled',
        ));

        $fieldset->addField('filter_type', 'select', array(
            'label' => Mage::helper('core')->__('Filter type'),
            'values' => array(
                array(
                    'value' => 'checkbox',
                    'label' => 'Check Box',
                ),
                array(
                    'value' => 'link',
                    'label' => 'Link',
                ),
                array(
                    'value' => 'color',
                    'label' => 'Color',
                ),
                array(
                    'value' => 'select',
                    'label' => 'Select',
                )),
            'value' => $model->getFilter_type(),
            'required' => true,
            'name' => 'filter_type',
        ));

        $fieldset->addField('attribute_id', 'hidden',
            array(
                'name' => 'id',
                'label' => Mage::helper('tax')->__('Id')
            )
        );


        $form->addValues($model->getData());
        $form->setUseContainer(true);
        return parent::_prepareForm();
    }
}
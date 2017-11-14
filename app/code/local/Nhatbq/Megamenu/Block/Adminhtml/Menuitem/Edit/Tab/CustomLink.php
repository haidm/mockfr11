<?php 
/**
* 
*/
class Nhatbq_MegaMenu_Block_Adminhtml_Menuitem_Edit_Tab_CustomLink extends Mage_Adminhtml_Block_Widget_Form
{
	
	protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $model = Mage::registry('menuitem_model');
        $fieldset = $form->addFieldset('custom_link',
            array('legend' => 'Custom link infomation'));
        $fieldset->addField('name', 'text', array(
            'label' => 'Menu item name',
            'name' => 'name',
            'class' => 'required-entry validate-alphanum',
        ));
        $fieldset->addField('link', 'text', array(
            'label' => 'Menu item link',
            'name' => 'link',
            'class' => 'required-entry validate-clean-url',
        ));
        $form->addValues($model->getData());
        return parent::_prepareForm();
    }
}
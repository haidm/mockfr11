<?php
class Hienth_MegaMenu_Block_Adminhtml_Menu_Edit_Tab_CustomLink extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $menuId = Mage::registry('menuId');
        $menuType = Mage::registry('menuType');
        $menuParent = Mage::registry('menuParent');
        $menuModel = Mage::registry('menumodel')->load($menuId);
        $this->setForm($form);
        $fieldset = $form->addFieldset('menuitem_form',
            array('legend' => 'Custom link'));
        $fieldset->addField('name','text',
            array(
                'name'   => 'name',
                'label' => 'Name Custom',
                'class' => 'required-entry validate-no-html-tags',
                'required' => true,
            ));
        $fieldset->addField('link','text',
            array(
                'name'   => 'link',
                'label' => 'Link Custom',
                'class' => 'required-entry validate-url',
                'required' => true,
            ));
        if($menuType)
        {
            $fieldset->addField('menuType','hidden',
                array(
                    'name'   => 'menuType',
                    'label' => 'menuType',
                    'value' => $menuType,
                ));
        }
        if($menuParent)
        {
            $fieldset->addField('menuParent','hidden',
                array(
                    'name'   => 'menuParent',
                    'label' => 'menuParent',
                    'value' => $menuParent,
                ));
        }
        if($menuId){
            $fieldset->addField('menuId','hidden',
                array(
                    'name'   => 'menuId',
                    'label' => 'menuId',
                    'value' => $menuId,
                ));
        }

        $form->addValues($menuModel->getData());
        $this->setForm($form);
        return parent::_prepareForm();
    }
}
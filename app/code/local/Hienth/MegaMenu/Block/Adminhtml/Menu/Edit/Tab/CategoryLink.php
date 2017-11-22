<?php
class Hienth_MegaMenu_Block_Adminhtml_Menu_Edit_Tab_CategoryLink extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $menuId = Mage::registry('menuId');
        $menuModel = Mage::registry('menumodel');
        $menuName = $menuModel->load($menuId)->name;
        $menuCategory = Mage::registry('menuCategory');
        foreach ($menuCategory as $key => $item){
            $data[$key]['label'] = $item->name;
            $data[$key]['value'] = $item->getId();
//            var_dump($data[$key]['value']);die;
            if ($menuName == $item->name){
                $select = $item->id;
            }
        }
        $this->setForm($form);
        $fieldset = $form->addFieldset('menuitem_form',
            array('legend' => 'Category link'));
        $fieldset->addField('category_id','select',
            array(
                'name'   => 'category_id',
                'label' => 'Category',
                'values' => $data,
                'value' => $select,
                'class' => 'required-entry validate-select',
                'required' => true,
            ));
        $menuType = Mage::registry('menuType');
        $menuParent = Mage::registry('menuParent');
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
        return parent::_prepareForm();
    }
}
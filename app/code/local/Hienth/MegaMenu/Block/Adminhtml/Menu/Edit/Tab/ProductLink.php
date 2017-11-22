<?php
class Hienth_MegaMenu_Block_Adminhtml_Menu_Edit_Tab_ProductLink extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $menuId = Mage::registry('menuId');
        $menuModel = Mage::registry('menumodel');
        $menuName = $menuModel->load($menuId)->name;
        $menuProduct = Mage::registry('menuProduct');
        foreach ($menuProduct as $key => $item){
            $data[$key]['label'] = $item->getName();
            $data[$key]['value'] = $item->getId();
//            var_dump($data[$key]);die;
            if ($menuName == $item->getName()){
                $select = $item->getId();
            }
        }
        $this->setForm($form);
        $fieldset = $form->addFieldset('menuitem_form',
            array('legend' => 'Product link'));
        $fieldset->addField('product_id','select',
            array(
                'name'   => 'product_id',
                'label' => 'Product',
                'values' => $data,
                'value' => $select,
                'class' => 'required-entry validate-select',
                'required' => true,
            ));
        $menuId = Mage::registry('menuId');

        $menuType = Mage::registry('menuType');
        $menuParent = Mage::registry('menuParent');
//        var_dump($menuId);die;
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
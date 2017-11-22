<?php
class Hienth_MegaMenu_Block_Adminhtml_Menu_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('menuItemForm');
        $this->setTitle(Mage::helper('core')->__('Menu Item'));
    }
    /**
     *
     * return Mage_Adminhtml_Block_Widget_Form
     */
    protected function _prepareForm()
    {
        $menuId = Mage::registry('menuId');
        $model = Mage::getModel('Hienth_MegaMenu/menu');
        $parentId = $model->load($menuId)->getParent_id();
        $menuType = $model->getType();
        $select = 0;
        if($menuType)
        {
            $selectType = $menuType;
        }
        $selects = array(array('value' => 0,'label' =>'None'));
        $models= Mage::getModel('Hienth_MegaMenu/menu')->getCollection();
        foreach ($models as $k => $m)
        {
            $selects[$k]['value'] = $m->getId();
            $selects[$k]['label'] = $m->getName();
            if($parentId == $m->getId()){
                $select = $parentId;
            }
        }
//        var_dump($select);die;
        $form = new Varien_Data_Form(array(
            'id' => 'new_form',
            'action' => $this->getData('action'),
            'method' => 'post'
        ));
        $fieldset = $form->addFieldset('base_fieldset', array(
            'legend' => Mage::helper('core')->__('Menu Item')
        ));
        $fieldset->addField('menu_id', 'select', array(
            'label' => Mage::helper('Hienth_MegaMenu')->__('Parent Menu'),
            'name' => 'menu_id',
            'values' => $selects,
            'value' => $select,
        ));
        $fieldset->addField('menu_type', 'select', array(
            'label' => Mage::helper('Hienth_MegaMenu')->__('Menu Type'),
            'name' => 'menu_type',
            'values' => array(
                array('value' => 'Category Link', 'label' => 'Category Link'),
                array('value' => 'Custom Link', 'label' => 'Custom Link'),
                array('value' => 'Product Link', 'label' => 'Product Link')),
            'value' => $selectType,
        ));
        $fieldset->addField('continute', 'submit', array(
//            'label' => Mage::helper('core')->__('Continute'),
            'value' => Mage::helper('Hienth_MegaMenu')->__('Continute'),
            'name'  => 'continute',
            'class' => 'form-button',
        ));
        if($menuId)
        {
            $fieldset->addField('id', 'hidden', array(
                'name' => 'id',
                'value' => $menuId,
            ));
        }
        $form->setUseContainer(true);
        $form->setAction($this->getUrl('*/menu/edit'));
        $this->setForm($form);
        return parent::_prepareForm();
    }
}
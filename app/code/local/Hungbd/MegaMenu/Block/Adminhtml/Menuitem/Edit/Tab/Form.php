<?php
/**
 * Created by PhpStorm.
 * User: hungbui
 * Date: 25/10/2017
 * Time: 17:07
 */

/**
 * Adminhtml Menuitem Tab Form
 *
 * @category   Mage
 * @package    Mage_Adminhtml
 * @author     Hung Bui
 */
class Hungbd_MegaMenu_Block_Adminhtml_Menuitem_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{

    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $model = Mage::registry('menuitem_model');
        $newmodel = Mage::registry('menuitem_type');
        $menuItemList = Mage::helper('Hungbd_MegaMenu/menu')->getListMenu();
        $hiden = $model->getHiden();
        $select = 0;
        $selectData = array(
            array('label' => 'none', 'value' => 0)
        );
        foreach ($menuItemList as $key => $item) {
            if ($key != $model->getId()) {
                $selectData[$key]['label'] = $item;
                $selectData[$key]['value'] = $key;
                if ($key == $model->getParentid()){
                    $select = $key;
                }
            }
        }
        $fieldset = $form->addFieldset('menuitem_form',
            array('legend' => 'Menu item infomation'));

        $fieldset->addField('parent_id', 'select',
            array(
                'name' => 'parent_id',
                'label' => 'Parent',
                'values' => $selectData,
                'value' => $select,
                'class' => 'required-entry validate-select',
                'required' => true,
            ));
        $fieldset->addField('hiden', 'select',
            array(
                'name' => 'hiden',
                'label' => 'Hiden',
                'values' => array(array('label' => 'no', 'value' => '0'),array('label' => 'yes', 'value' => '1')),
                'value' => $hiden,
            ));

        if ($newmodel){
            $fieldset->addField('type', 'hidden', array(
                'name' => 'type',
                'label' => 'type',
                'value' => $newmodel,
                'class' => 'required-entry validate-select',
                'required' => true,
            ));
        }

        if ($model->getId()) {
            $fieldset->addField('id', 'hidden',
                array(
                    'name' => 'id',
                    'label' => Mage::helper('core')->__('Id')
                )
            );
            $fieldset->addField('type', 'hidden', array(
                'name' => 'type',
                'label' => 'type',
            ));
        }

        $form->addValues($model->getData());
        return parent::_prepareForm();
    }
}

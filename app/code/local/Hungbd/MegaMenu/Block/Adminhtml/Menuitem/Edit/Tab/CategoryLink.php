<?php
/**
 * Created by PhpStorm.
 * User: hungbui
 * Date: 27/10/2017
 * Time: 09:46
 */

/**
 * Category link tab
 * @category    Hungbd
 * @package     Hungbd_Megamenu_Adminhtml
 * @author      hungbd <hungbd@smartosc.com>
 */
class Hungbd_MegaMenu_Block_Adminhtml_Menuitem_Edit_Tab_CategoryLink extends Mage_Adminhtml_Block_Widget_Form
{

    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $menuItem = Mage::registry('menuitem_model');
        $model = Mage::registry('category');
        foreach ($model as $key => $item){
            $data[$key]['label'] = $item->name;
            $data[$key]['value'] = $item->getId();
            if ($menuItem->getName() == $item->name){
                $select = $item->getId();
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


        return parent::_prepareForm();
    }
}
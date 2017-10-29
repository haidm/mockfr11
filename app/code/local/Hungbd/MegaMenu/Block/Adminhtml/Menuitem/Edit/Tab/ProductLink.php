<?php
/**
 * Created by PhpStorm.
 * User: hungbui
 * Date: 27/10/2017
 * Time: 10:19
 */
/**
 * Tab Product link
 * @category    Hungbd
 * @package     Hungbd_Megamenu_Adminhtml
 * @author      hungbd <hungbd@smartosc.com>
 */
class Hungbd_MegaMenu_Block_Adminhtml_Menuitem_Edit_Tab_ProductLink extends Mage_Adminhtml_Block_Widget_Form
{

    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $model = Mage::registry('product_list');
        foreach ($model as $key => $item){
            $data[$key]['label'] = $item->name." ($item->sku)";
            $data[$key]['value'] = $item->sku;
            if ($model->name == $item->name){
                $select = $item->sku;
            }
        }
        $this->setForm($form);
        $fieldset = $form->addFieldset('menuitem_form',
            array('legend' => 'Product link'));
        $fieldset->addField('product_sku','select',
            array(
                'name'   => 'product_sku',
                'label' => 'Product',
                'values' => $data,
                'value' => $select,
                'class' => 'required-entry validate-select',
                'required' => true,
            ));


        return parent::_prepareForm();
    }
}
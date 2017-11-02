<?php
/**
 * Created by PhpStorm.
 * User: hungbui
 * Date: 26/10/2017
 * Time: 11:09
 */
/**
 * Category New form
 * @category    Hungbd
 * @package     Hungbd_Megamenu_Adminhtml
 * @author      hungbd <hungbd@smartosc.com>
 */
class Hungbd_MegaMenu_Block_Adminhtml_Menuitem_New extends Mage_Adminhtml_Block_Widget_Form
{
    /**
     * Init class
     */
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
        $form = new Varien_Data_Form(array(
            'id' => 'new_form',
            'action' => $this->getData('action'),
            'method' => 'post'
        ));

        $fieldset = $form->addFieldset('base_fieldset', array(
            'legend' => Mage::helper('core')->__('Menu Item')
        ));

        $fieldset->addField('menuitem_type', 'select', array(
            'label' => Mage::helper('core')->__('Menu item type'),
            'name' => 'menuitem_type',
            'values' => array(
                array('value' => 'Category link', 'label' => 'Category link'),
                array('value' => 'Custom link', 'label' => 'Custom link'),
                array('value' => 'Product link', 'label' => 'Product link')),
        ));

        $fieldset->addField('continute', 'submit', array(
                'label' => Mage::helper('core')->__('Continute'),
            'value' => Mage::helper('core')->__('Continute'),
            'name'  => 'continute',
            'class' => 'form-button',
        ));

        $form->setUseContainer(true);
        $form->setAction($this->getUrl('*/menu/edit'));
        $this->setForm($form);

        return parent::_prepareForm();
    }
}

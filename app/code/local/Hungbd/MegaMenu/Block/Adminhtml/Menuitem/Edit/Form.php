<?php
/**
 * Created by PhpStorm.
 * User: hungbui
 * Date: 25/10/2017
 * Time: 17:07
 */

/**
 * Adminhtml Menuitem Edit Form
 *
 * @category   Mage
 * @package    Mage_Adminhtml
 * @author     Hung Bui
 */
class Hungbd_MegaMenu_Block_Adminhtml_Menuitem_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    /**
     *
     * return Mage_Adminhtml_Block_Widget_Form
     */
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form(array(
            'id' => 'edit_form',
            'action' => $this->getUrl('*/*/save'),
            array('id' => $this->getRequest()->getParam('id')),
            'method' => 'post',
        ));
        $form->setUseContainer(true);
        $this->setForm($form);
        return parent::_prepareForm();
    }
}

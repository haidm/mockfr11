<?php
/**
 * Created by PhpStorm.
 * User: nddang196
 * Date: 21-10-2017
 * Time: 08:28 SA
 */

class Datdt_MegaMenu_Block_Adminhtml_Category_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        $this->_objectId = 'category';
        $this->_controller = 'adminhtml_category';
        $this->_blockGroup = 'datdt_megamenu';

        parent::__construct();

        $model = Mage::registry('categoryModel');

        $this->_updateButton('save', 'lable', Mage::helper('datdt_megamenu')->__('Save'));
        $this->_addButton('delete', array(
            'label'   => Mage::helper('datdt_megamenu')->__('Delete'),
            'onclick' => "window.location.href='{$this->getUrl('*/*/delete', array('id' => $model->getId()))}'",
            'class'   => 'delete'
        ), 10);
        $this->_addButton('save_and_continue', array(
            'label'   => Mage::helper('datdt_megamenu')->__('Save and Continue Edit'),
            'onclick' => 'saveAndContinueEdit()',
            'class'   => 'save'
        ), 10);

        $this->_formScripts[] = "function saveAndContinueEdit() {" .
            "editForm.submit($('edit_form').action + 'back/edit/')" .
            "}";
    }
}
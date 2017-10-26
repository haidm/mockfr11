<?php
/**
 * Created by PhpStorm.
 * User: nddang196
 * Date: 26-10-2017
 * Time: 11:14 SA
 */

class Dangnd_Slider_Block_Adminhtml_Slide_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        $this->_objectId = 'slide';
        $this->_controller = 'adminhtml_slide';
        $this->_blockGroup = 'dangnd_slider';

        parent::__construct();

        $model = Mage::registry('slideModel');

        $this->_updateButton('save', 'label', Mage::helper('dangnd_slider')->__('Save'));
        $this->_addButton('delete', array(
            'label'   => Mage::helper('dangnd_slider')->__('Delete'),
            'onclick' => "window.location.href='{$this->getUrl('*/*/delete', array('id' => $model->getId()))}'",
            'class'   => 'delete'
        ));
        $this->_addButton('save_and_continue', array(
            'label'   => Mage::helper('dangnd_slider')->__('Save and Continue Edit'),
            'onclick' => 'saveAndContinueEdit()',
            'class'   => 'save'
        ));

        $this->_formScripts[] = "function saveAndContinueEdit() {" .
            "editForm.submit($('edit_form').action + 'back/edit/')" .
            "}";
    }
}
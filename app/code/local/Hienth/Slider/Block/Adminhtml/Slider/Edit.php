<?php
class Hienth_Slider_Block_Adminhtml_Slider_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{

    public function __construct()
    {
        $this->_objectId = 'slider';
        $this->_controller = 'adminhtml_slider';
        $this->_blockGroup = 'Hienth_Slider';
        $this->_headerText = Mage::helper('Hienth_Slider')->__('Form Slider');
        parent::__construct();
        $sliderId = Mage::registry('sliderId');
        if($sliderId)
        {
            $this->_addButton('delete', array(
                'label'     => Mage::helper('core')->__('Delete Slider'),
                'onclick'   => "window.location.href = '" . $this->getUrl("*/slider/delete", array("id" => $sliderId)) . "'",
                'class' => 'delete'
            ), 10);
        }
        $this->_updateButton('save', 'label', Mage::helper('Hienth_Slider')->__('Save Slider'));
        $this->_addButton('save_and_continue', array(
            'label'     => Mage::helper('Hienth_Slider')->__('Save and Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class' => 'save'
        ), 10);
        $this->removeButton('reset');
        $this->_formScripts[] = " function saveAndContinueEdit(){ editForm.submit($('edit_form').action + 'back/edit/') } ";
    }

}
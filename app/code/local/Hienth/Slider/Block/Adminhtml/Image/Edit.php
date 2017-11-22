<?php
class Hienth_Slider_Block_Adminhtml_Image_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{

    public function __construct()
    {
        $this->_objectId = 'image';
        $this->_controller = 'adminhtml_image';
        $this->_blockGroup = 'Hienth_Slider';
        $this->_headerText = Mage::helper('Hienth_Slider')->__('Form Image');
        parent::__construct();
        $imageId = Mage::registry('imageId');
        if($imageId)
        {
            $this->_addButton('delete', array(
                'label'     => Mage::helper('core')->__('Delete Image'),
                'onclick'   => "window.location.href = '" . $this->getUrl("*/image/delete", array("id" => $imageId)) . "'",
                'class' => 'delete'
            ), 10);
        }
        $this->_updateButton('save', 'label', Mage::helper('Hienth_Slider')->__('Save Image'));
        $this->_addButton('save_and_continue', array(
            'label'     => Mage::helper('Hienth_Slider')->__('Save and Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class' => 'save'
        ), 10);
        $this->removeButton('reset');
        $this->_formScripts[] = " function saveAndContinueEdit(){ editForm.submit($('edit_form').action + 'back/edit/') } ";
    }

}
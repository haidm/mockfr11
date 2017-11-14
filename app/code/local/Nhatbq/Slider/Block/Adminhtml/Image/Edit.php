<?php 
/**
* 
*/
class Nhatbq_Slider_Block_Adminhtml_Image_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
	
	 public function __construct()
    {
        parent::__construct();
        $this->_objectId = 'id';
        $this->_controller = 'adminhtml_image';
        $this->_blockGroup = 'nhatbq_slider';
        $model = Mage::registry('slider_image');
        $this->_headerText = Mage::helper('tax')
            ->__('Image '.$model->getName());
        $this->_updateButton('save', 'label', Mage::helper('tax')->__('Save Image'));
        $this->_updateButton('delete', array(
            'label'     => Mage::helper('tax')->__('Delete Image'),
            'onclick'   => "window.location.href = '" . $this->getUrl("*/*/ delete", array("id" => $model->getId())) . "'",
            'class' => 'delete'
        ), 10);
        $this->_addButton('save_and_continue', array(
            'label'     => Mage::helper('tax')->__('Save and Continue Editing'),
            'onclick'   => 'saveAndContinueEdit()',
            'class' => 'save'
        ), 10);
        $this->_removeButton('reset');
        $this->_formScripts[] = " function saveAndContinueEdit(){ editForm.submit($('edit_form').action + 'back/edit/') } ";
    }
}
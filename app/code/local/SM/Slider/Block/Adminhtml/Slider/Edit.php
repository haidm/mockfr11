<?php

class SM_Slider_Block_Adminhtml_Slider_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    /**
     * Init class
     *
     */
    public function __construct()
    {
        parent::__construct();
        $this->_objectId = 'id';
        $this->_controller = 'adminhtml_slider';
        $this->_blockGroup = 'sm_slider';
        $model = Mage::registry('slider');
        $this->_headerText = Mage::helper('core')
            ->__('Slider '.$model->getName());
        //$this->_updateButton('save', array('label'     => Mage::helper('core')->__('Save Slider')));
        $this->_updateButton('delete', array(
            'label'     => Mage::helper('tax')->__('Delete Slider'),
            'onclick'   => "window.location.href = '" . $this->getUrl("*/*/ delete", array("id" => $model->getId())) . "'",
            'class' => 'delete'
        ), 10);

        $this->_addButton('save_and_continue', array(
            'label'     => Mage::helper('tax')->__('Save Slider'),
            'onclick'   => 'saveAndContinueEdit()',
            'class' => 'save'
        ), 10);
        $this->_removeButton('reset');
        $this->_removeButton('save');

        $this->_formScripts[] = " function saveAndContinueEdit(){ editForm.submit($('edit_form').action + 'back/edit/') } ";

    }
}
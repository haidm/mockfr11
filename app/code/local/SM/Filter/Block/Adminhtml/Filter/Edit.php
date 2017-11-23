<?php

class SM_Filter_Block_Adminhtml_Filter_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    /**
     * Init class
     *
     */
    public function __construct()
    {
        parent::__construct();
        $this->_objectId = 'id';
        $this->_controller = 'adminhtml_filter';
        $this->_blockGroup = 'sm_filter';
        $model = Mage::registry('fitler_model');
        $this->_headerText = Mage::helper('core')
            ->__('Filter '.$model->frontend_label);
        $this->_updateButton('save', 'label', Mage::helper('sm_filter')->__('Save Filter'));
        $this->_addButton('save_and_continue', array(
            'label'     => Mage::helper('sm_filter')->__('Save and Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class' => 'save'
        ), 10);
        $this->_removeButton('reset');
        $this->_removeButton('delete');

        $this->_formScripts[] = " function saveAndContinueEdit(){ editForm.submit($('edit_form').action + 'back/edit/') } ";
    }
}
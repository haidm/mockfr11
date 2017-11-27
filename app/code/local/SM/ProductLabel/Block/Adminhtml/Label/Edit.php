<?php

class SM_ProductLabel_Block_Adminhtml_Label_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    /**
     * Init class
     *
     */
    public function __construct()
    {
        parent::__construct();
        $this->_objectId = 'id';
        $this->_controller = 'adminhtml_label';
        $model = Mage::registry('label');
        $this->_headerText = Mage::helper('tax')
            ->__('Image '.$model->getName());
        $this->_updateButton('save', 'label', Mage::helper('tax')->__('Save Label'));
        $this->_updateButton('delete', array(
            'label'     => Mage::helper('tax')->__('Delete Label'),
            'onclick'   => "window.location.href = '" . $this->getUrl("*/*/ delete", array("id" => $model->getId())) . "'",
            'class' => 'delete'
        ), 10);

        $this->_addButton('save_and_continue', array(
            'label'     => Mage::helper('tax')->__('Save and Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class' => 'save'
        ), 10);
        $this->_removeButton('reset');

        $this->_formScripts[] = " function saveAndContinueEdit(){ editForm.submit($('edit_form').action + 'back/edit/') } ";
    }
}
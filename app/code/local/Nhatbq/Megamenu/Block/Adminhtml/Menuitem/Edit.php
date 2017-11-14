<?php 
class Nhatbq_MegaMenu_Block_Adminhtml_Menuitem_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    /**
     * Init class
     *
     */
    public function __construct()
    {
        parent::__construct();
        $this->_objectId = 'id';
        $this->_controller = 'adminhtml_menuitem';
        $this->_blockGroup = 'nhatbq_megamenu';
        $model = Mage::registry('menuitem_model');
        $this->_headerText = Mage::helper('core')
            ->__('Menu item '.$model->getName());
        $this->_updateButton('save', 'label', Mage::helper('core')->__('Save Menu Item'));
        $this->_updateButton('delete', array(
            'label'     => Mage::helper('core')->__('Delete Menu Item'),
            'onclick'   => "window.location.href = '" . $this->getUrl("*/*/ delete", array("id" => $model->getId())) . "'",
            'class' => 'delete'
        ), 10);
        $this->_addButton('save_and_continue', array(
            'label'     => Mage::helper('core')->__('Save and Continue Editing'),
            'onclick'   => 'saveAndContinueEdit()',
            'class' => 'save'
        ), 10);
        $this->_removeButton('reset');
        $this->_formScripts[] = " function saveAndContinueEdit(){ editForm.submit($('edit_form').action + 'back/edit/') } ";
    }
}
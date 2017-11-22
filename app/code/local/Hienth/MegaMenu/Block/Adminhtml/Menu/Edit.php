<?php
class Hienth_MegaMenu_Block_Adminhtml_Menu_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{

    public function __construct()
    {
        $this->_objectId = 'megamenu';
        $this->_controller = 'adminhtml_menu';
        $this->_blockGroup = 'Hienth_MegaMenu';
        $this->_headerText = Mage::helper('Hienth_MegaMenu')->__('Form Menu');
        parent::__construct();
        $menuId = Mage::registry('menuId');
        $menuType = Mage::registry('menuType');
        if($menuId)
        {
            $this->_addButton('delete', array(
                'label'     => Mage::helper('core')->__('Delete Menu'),
                'onclick'   => "window.location.href = '" . $this->getUrl("*/menu/delete", array("id" => $menuId)) . "'",
                'class' => 'delete'
            ), 10);
        }
        if($menuType){
            $this->_updateButton('save', 'label', Mage::helper('Hienth_MegaMenu')->__('Save Menu'));
            $this->_addButton('save_and_continue', array(
                'label'     => Mage::helper('Hienth_MegaMenu')->__('Save and Continue Edit'),
                'onclick'   => 'saveAndContinueEdit()',
                'class' => 'save'
            ), 10);
        }
        else{
            $this->removeButton('save');
        }
        $this->removeButton('reset');
        $this->_formScripts[] = " function saveAndContinueEdit(){ editForm.submit($('edit_form').action + 'back/edit/') } ";
    }

}
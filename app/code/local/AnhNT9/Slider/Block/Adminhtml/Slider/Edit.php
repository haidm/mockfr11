<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 10/30/2017
 * Time: 5:52 PM
 */
class AnhNT9_Slider_Block_Adminhtml_Slider_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    /**
     * Init class
     *
     */
    public function __construct()
    {

        $this->_objectId = 'slider';
        $this->_controller = 'adminhtml_slider';
        $this->_blockGroup = 'anhnt9_slider';

        parent::__construct();

        $model = Mage::registry('slidermodel');


        $this->_updateButton('save', 'label', Mage::helper('anhnt9_slider')->__('Save Album'));
        $this->_addButton('delete', array(
            'label'     => Mage::helper('anhnt9_slider')->__('Delete Album'),
            'onclick'   => "window.location.href = '" . $this->getUrl("*/*/delete", array("slider_id" => $model->getId())) . "'",
            'class' => 'delete'
        ), 10);
        $this->_addButton('save_and_continue', array(
            'label'     => Mage::helper('anhnt9_slider')->__('Save and Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class' => 'save'
        ), 10);
        $this->_formScripts[] = " function saveAndContinueEdit(){ editForm.submit($('edit_form').action + 'back/edit/') } ";
    }
}
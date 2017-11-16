<?php
/**
 * Created by PhpStorm.
 * User: hungbui
 * Date: 14/11/2017
 * Time: 10:23
 */
/**
 * Filter Edit Container
 * @category    Hungbd
 * @package     Hungbd_Filter_Adminhtml
 * @author      hungbd <hungbd@smartosc.com>
 */
class Hungbd_Filter_Block_Adminhtml_Filter_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
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
        $this->_blockGroup = 'hungbd_filter';
        $model = Mage::registry('fitler_model');
        $this->_headerText = Mage::helper('core')
            ->__('Filter '.$model->frontend_label);
        $this->_updateButton('save', 'label', Mage::helper('hungbd_filter')->__('Save Filter'));
        $this->_addButton('save_and_continue', array(
            'label'     => Mage::helper('hungbd_filter')->__('Save and Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class' => 'save'
        ), 10);
        $this->_removeButton('reset');
        $this->_removeButton('delete');

        $this->_formScripts[] = " function saveAndContinueEdit(){ editForm.submit($('edit_form').action + 'back/edit/') } ";
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: hungbui
 * Date: 29/10/2017
 * Time: 16:31
 */
/**
 * Image Edit Container
 * @category    Hungbd
 * @package     Hungbd_Slider_Adminhtml
 * @author      hungbd <hungbd@smartosc.com>
 */
class Hungbd_Slider_Block_Adminhtml_Image_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    /**
     * Init class
     *
     */
    public function __construct()
    {
        parent::__construct();
        $this->_objectId = 'id';
        $this->_controller = 'adminhtml_image';
        $this->_blockGroup = 'hungbd_slider';
        $model = Mage::registry('slider_image');
        $this->_headerText = Mage::helper('Hungbd_Slider')
            ->__('Image '.$model->getName());
        $this->_updateButton('save', 'label', Mage::helper('Hungbd_Slider')->__('Save Image'));
        $this->_updateButton('delete', array(
            'label'     => Mage::helper('Hungbd_Slider')->__('Delete Image'),
            'onclick'   => "window.location.href = '" . $this->getUrl("*/*/ delete", array("id" => $model->getId())) . "'",
            'class' => 'delete'
        ), 10);

        $this->_addButton('save_and_continue', array(
            'label'     => Mage::helper('Hungbd_Slider')->__('Save and Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class' => 'save'
        ), 10);
        $this->_removeButton('reset');

        $this->_formScripts[] = " function saveAndContinueEdit(){ editForm.submit($('edit_form').action + 'back/edit/') } ";
    }
}
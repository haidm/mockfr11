<?php
/**
 * Created by PhpStorm.
 * User: nddang196
 * Date: 26-10-2017
 * Time: 09:42 SA
 */

class Dangnd_Slider_Block_Adminhtml_Images_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        $this->_objectId = 'img';
        $this->_controller = 'adminhtml_images';
        $this->_blockGroup = 'dangnd_slider';

        parent::__construct();

        $model = Mage::registry('imgModel');

        $this->_updateButton('save', 'label', Mage::helper('dangnd_slider')->__('Save Image'));
        $this->_addButton('delete', array(
            'label'   => Mage::helper('dangnd_slider')->__('Delete Image'),
            'onclick' => "window.location.href='{$this->getUrl('*/*/delete', array('id' => $model->getId()))}'",
            'class'   => 'delete'
        ));
        $this->_addButton('save_and_continue', array(
            'label'   => Mage::helper('dangnd_slider')->__('Save and Continue Edit'),
            'onclick' => 'saveAndContinueEdit()',
            'class'   => 'save'
        ));

        $this->_formScripts[] = "function saveAndContinueEdit() {" .
            "editForm.submit($('edit_form').action + 'back/edit/')" .
            "}";
        $this->_formScripts[] = "function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        document.getElementById('preview').src = e.target.result;
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            }";
    }

    public function getHeaderText()
    {
        if (Mage::registry('slideModel')->getId()) {
            return Mage::helper('dangnd_slider')->__('Edit Information');
        } else {
            return Mage::helper('dangnd_slider')->__('Create Image Slide');

        }
    }
}
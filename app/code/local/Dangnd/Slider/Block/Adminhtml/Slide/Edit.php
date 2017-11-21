<?php
/**
 * Created by PhpStorm.
 * User: nddang196
 * Date: 26-10-2017
 * Time: 11:14 SA
 */

class Dangnd_Slider_Block_Adminhtml_Slide_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        $this->_objectId = 'id';
        $this->_controller = 'adminhtml_slide';
        $this->_blockGroup = 'dangnd_slider';

        parent::__construct();

        $model = Mage::registry('slideModel');

        $this->_updateButton('save', 'label', Mage::helper('dangnd_slider')->__('Save'));
        $this->_addButton('delete', [
            'label'   => Mage::helper('dangnd_slider')->__('Delete'),
            'onclick' => "window.location.href='{$this->getUrl('*/*/delete', ['id' => $model->getId()])}'",
            'class'   => 'delete'
        ]);
        $this->_addButton('save_and_continue', [
            'label'   => Mage::helper('dangnd_slider')->__('Save and Continue Edit'),
            'onclick' => 'saveAndContinueEdit()',
            'class'   => 'save'
        ]);

        $this->_formScripts[] = "function saveAndContinueEdit() {" .
            "editForm.submit($('edit_form').action + 'back/edit/')" .
            "}";
        $this->_formScripts[] = "function readOne(input, id, index) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        document.getElementById(id).src = e.target.result;
                    };

                    reader.readAsDataURL(input.files[index]);
                }
            }";
        $this->_formScripts[] = "function readMulti(input) {
            document.getElementById('newImg').innerHTML = ''; 
            if (input.files && input.files[0]) {
                var html = ''; 
                for (var i = 0; i < input.files.length; i++) {  
                    html += \" <img id = 'new\" + i + \"' src = '' height = '100px' />\";                   
                }
                document.getElementById('newImg').innerHTML = html;  
                
                for (var i = 0; i < input.files.length; i++) {  
                    readOne(input, 'new'+i, i);                   
                }    
            }
        }";
    }

    public function getHeaderText()
    {
        if (Mage::registry('slideModel')->getId()) {
            return Mage::helper('dangnd_slider')->__('Edit Slide Information');
        } else {
            return Mage::helper('dangnd_slider')->__('New Slide');

        }
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: nddang
 * Date: 31-10-2017
 * Time: 4:56 CH
 */

class Dangnd_Slider_Block_Adminhtml_Slide_Edit_Tab_Images extends Mage_Adminhtml_Block_Widget_Form
{
    public function _prepareForm()
    {
        $model = Mage::registry('imgModel');

        $form = new Varien_Data_Form();

        $fieldset = $form->addFieldset('base', array(
            'legend' => Mage::helper('dangnd_slider')->__('Images of Slide')
        ));
        $fieldset->addType('image', 'Dangnd_Slider_Block_Adminhtml_Helper_Image');
        $fieldset->addField('image', 'image', array(
            'name'     => 'image[]',
            'label'    => Mage::helper('dangnd_slider')->__('Image'),
            'class'    => 'required-entry',
            'multiple' => 'multiple'
        ));

        $form->addValues($model->getData());
        $this->setForm($form);

        return parent::_prepareForm();
    }
}
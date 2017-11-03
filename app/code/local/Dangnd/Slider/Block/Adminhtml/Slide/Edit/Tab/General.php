<?php
/**
 * Created by PhpStorm.
 * User: nddang
 * Date: 31-10-2017
 * Time: 4:25 CH
 */

class Dangnd_Slider_Block_Adminhtml_Slide_Edit_Tab_General extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $model = Mage::registry('slideModel');

        $form = new Varien_Data_Form();

        $fieldset = $form->addFieldset('base', [
            'legend' => Mage::helper('dangnd_slider')->__('Information')
        ]);
        $fieldset->addField('name', 'text', [
            'name'     => 'name',
            'label'    => Mage::helper('dangnd_slider')->__('Name'),
            'class'    => 'required-entry',
            'required' => true,
        ]);

        if ($model->getId()) {
            $fieldset->addField('id', 'hidden', [
                'name' => 'id',
            ]);
        }

        $form->addValues($model->getData());
        $this->setForm($form);

        return parent::_prepareForm();
    }

}
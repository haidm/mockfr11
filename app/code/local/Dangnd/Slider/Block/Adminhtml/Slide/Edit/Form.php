<?php
/**
 * Created by PhpStorm.
 * User: nddang196
 * Date: 26-10-2017
 * Time: 11:15 SA
 */

class Dangnd_Slider_Block_Adminhtml_Slide_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    public function __construct()
    {
        parent::__construct();

        $this->setId('slideFrm');
        $this->setTitle(Mage::helper('dangnd_slider')->__('Information'));
    }

    public function _prepareForm()
    {
        $model = Mage::registry('slideModel');

        $form = new Varien_Data_Form(array(
            'id'     => 'edit_form',
            'action' => $this->getData('action'),
            'method' => 'post'
        ));

        $fieldset = $form->addFieldset('base', array(
            'ledend' => Mage::helper('dangnd_slider')->__('Information')
        ));
        $fieldset->addField('name', 'text', array(
            'name'     => 'name',
            'label'    => Mage::helper('dangnd_slider')->__('Name'),
            'class'    => 'required-entry',
            'required' => true,
        ));

        if ($model->getId())
        {
            $fieldset->addField('id', 'hidden', array(
                'name' => 'id',
            ));
        }

        $form->addValues($model->getData());
        $form->setUseContainer(true);
        $form->setAction($this->getUrl('*/slide/save'));

        $this->setForm($form);

        return parent::_prepareForm();
    }
}
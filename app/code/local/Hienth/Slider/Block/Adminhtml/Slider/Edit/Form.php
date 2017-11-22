<?php
class Hienth_Slider_Block_Adminhtml_Slider_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('sliderForm');
        $this->setTitle(Mage::helper('Hienth_Slider')->__('Information'));
    }
    public function _prepareForm()
    {
        $listImage = Mage::getModel('Hienth_Slider/image')->getCollection();
        $selects = array();
        foreach ($listImage as $image)
        {
            $selects[] = array(
                'value' => $image->getId(),
                'label' => $image->getName()
            );
        }
        $sliderId = Mage::registry('sliderId');
        $form = new Varien_Data_Form(array(
            'id'      => 'edit_form',
            'action'  => $this->getData('action'),
            'method'  => 'post',
            'enctype' => 'multipart/form-data'
        ));
        $fieldset = $form->addFieldset('base', array(
            'ledend' => Mage::helper('Hienth_Slider')->__('Information')
        ));
        if ($sliderId) {
            $fieldset->addField('sliderId', 'hidden', array(
                'name' => 'sliderId',
                'value' => $sliderId
            ));
        }
        $fieldset->addField('name', 'text', array(
            'label'     => Mage::helper('Hienth_Slider')->__('Slider Name'),
            'name'      => 'name',
            'required'  => true,
            'class'     => 'validate-no-html-tags required-entry'
        ));
        $fieldset->addField('list_image', 'multiselect', array(
            'label' => Mage::helper('Hienth_Slider')->__('List Image'),
            'name' => 'list_image',
            'required' => false,
            'values' => $selects,
        ));
        $modelSlider = Mage::registry('modelSlider');
//        var_dump($modelSlider->getData());die;
        $form->addValues($modelSlider->getData());
        $form->setUseContainer(true);
        $form->setAction($this->getUrl('*/slider/save'));
        $this->setForm($form);
        return parent::_prepareForm();
    }
}
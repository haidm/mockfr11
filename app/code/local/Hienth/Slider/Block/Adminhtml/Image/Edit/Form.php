<?php
class Hienth_Slider_Block_Adminhtml_Image_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('imageForm');
        $this->setTitle(Mage::helper('Hienth_Slider')->__('Information'));
    }
    public function _prepareForm()
    {
//        $img = '';
//        $model = Mage::registry('imgModel');
//        $listSlide = Mage::getModel('dangnd_slider/slide')->getCollection();
//        $menuSelect = array();
//        foreach ($listSlide as $item) {
//            $menuSelect[] = array(
//                'value' => $item->getId(),
//                'label' => $item->getName()
//            );
//        }
        $imageName = Mage::registry('modelImage')->getName();
        $imageName = str_replace(' ','',$imageName);
        $imageName = str_replace('(','_',$imageName);
        $imageName = str_replace(')','_',$imageName);
        $img = Mage::getBaseUrl('media').'hienth/image/'.$imageName;
        $modelImage = Mage::registry('modelImage');
        $imageId = Mage::registry('imageId');
        $form = new Varien_Data_Form(array(
            'id'      => 'edit_form',
            'action'  => $this->getData('action'),
            'method'  => 'post',
            'enctype' => 'multipart/form-data'
        ));
        $fieldset = $form->addFieldset('base', array(
            'ledend' => Mage::helper('Hienth_Slider')->__('Information')
        ));
        if ($imageId) {
            $fieldset->addField('imageId', 'hidden', array(
                'name'  => 'imageId',
                'value' => $imageId
            ));
            $fieldset->addField('img', 'hidden', array(
                'name'  => 'img',
                'value' => $imageName
            ));
            $fieldset->addField('image', 'image', array(
                'label'              => Mage::helper('Hienth_Slider')->__('Image'),
                'name'               => 'image',
                'required'           => true,
                'onchange'           => 'readURL(this);',
                'note'               => '(*.jpg, *.jpeg, *.png, *.gif)',
                'renderer'           => 'Hienth_Slider_Block_Adminhtml_Image_Renderer_Image',
                'after_element_html' => "<br><img id='preview' src='{$img}' height='100px' />"
            ));
            $fieldset->addField('is_enabled','checkbox', array(
                'header'   => Mage::helper('Hienth_Slider')->__('General'),
                'width'    => '20px',
                'name'     => 'is_enabled',
                'value'    => 1,
                'onclick'  => 'this.value == this.checked ? 1 : 0',
                'note'     => Mage::helper('Hienth_Slider')->__('Delete Image')
            ));
        }
        else
        {
            $fieldset->addField('image', 'image', array(
                'label'              => Mage::helper('Hienth_Slider')->__('Image'),
                'name'               => 'image',
                'required'           => true,
                'class'              => 'required-entry',
                'onchange'           => 'readURL(this);',
                'note'               => '(*.jpg, *.jpeg, *.png, *.gif)',
            ));
        }
        $fieldset->addField('link', 'text', array(
            'name'  => 'link',
            'label' => Mage::helper('Hienth_Slider')->__('Link'),
            'class' => 'validate-url'
        ));
        $fieldset->addField('text', 'editor', array(
            'name'  => 'text',
            'label' => Mage::helper('Hienth_Slider')->__('Text'),
            'class' => 'validate-no-html-tags'
        ));
        $form->addValues($modelImage->getData());
        $form->setUseContainer(true);
        $form->setAction($this->getUrl('*/image/save'));
        $this->setForm($form);
        return parent::_prepareForm();
    }
}
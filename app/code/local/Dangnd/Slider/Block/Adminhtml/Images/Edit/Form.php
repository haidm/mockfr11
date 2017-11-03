<?php
/**
 * Created by PhpStorm.
 * User: nddang196
 * Date: 26-10-2017
 * Time: 09:43 SA
 */

class Dangnd_Slider_Block_Adminhtml_Images_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    public function __construct()
    {
        parent::__construct();

        $this->setId('itemFrm');
        $this->setTitle(Mage::helper('dangnd_slider')->__('Information'));
    }

    public function _prepareForm()
    {
        $img = '';
        $model = Mage::registry('imgModel');
        $listSlide = Mage::getModel('dangnd_slider/slide')->getCollection();
        $menuSelect = array();

        foreach ($listSlide as $item) {
            $menuSelect[] = array(
                'value' => $item->getId(),
                'label' => $item->getName()
            );
        }

        $form = new Varien_Data_Form(array(
            'id'      => 'edit_form',
            'action'  => $this->getData('action'),
            'method'  => 'post',
            'enctype' => 'multipart/form-data'
        ));

        $fieldset = $form->addFieldset('base', array(
            'ledend' => Mage::helper('dangnd_slider')->__('Information')
        ));
        $fieldset->addField('slideId', 'select', array(
            'name'     => 'slideId',
            'label'    => Mage::helper('dangnd_slider')->__('Slide'),
            'class'    => 'required-entry',
            'values'   => $menuSelect,
            'required' => true
        ));
        if ($model->getId()) {
            $img = Mage::getBaseUrl('media') . 'dangnd/slide/' . $model->getName();
            $fieldset->addField('id', 'hidden', array(
                'name' => 'id',
            ));
        }
        $fieldset->addField('image', 'image', array(
            'name'               => 'image',
            'label'              => Mage::helper('dangnd_slider')->__('Image'),
            'required'           => false,
            'onchange'           => 'readURL(this);',
            'renderer'           => 'dangnd_slider/adminhtml_images_renderer_image',
            'after_element_html' => "<br><img id='preview' src='{$img}' height='100px' />"
        ));
        $fieldset->addField('content', 'editor', array(
            'name'  => 'content',
            'label' => Mage::helper('dangnd_slider')->__('Content'),
        ));
        $fieldset->addField('link', 'text', array(
            'name'  => 'link',
            'label' => Mage::helper('dangnd_slider')->__('Link'),
        ));

        $form->addValues($model->getData());
        $form->setUseContainer(true);
        $form->setAction($this->getUrl('*/images/save'));

        $this->setForm($form);

        return parent::_prepareForm();
    }
}
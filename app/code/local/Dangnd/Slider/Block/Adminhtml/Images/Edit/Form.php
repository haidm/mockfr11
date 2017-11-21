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
        $new = 1;
        $preview = '';
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

        if ($model->getId()) {
            $fieldset->addField('id', 'hidden', array(
                'name' => 'id',
            ));
            $new = 0;
            $preview = $this->previewImg($model);
        }
        $fieldset->addField('slideId', 'select', array(
            'name'     => 'slideId',
            'label'    => Mage::helper('dangnd_slider')->__('Slide'),
            'class'    => 'required-entry',
            'values'   => $menuSelect,
            'required' => true
        ));
        $fieldset->addField('image', 'image', array(
            'name'               => 'image',
            'label'              => Mage::helper('dangnd_slider')->__('Image'),
            'required'           => false,
            'onchange'           => "previewImage(this, $new);",
            'renderer'           => 'dangnd_slider/adminhtml_images_renderer_image',
            'after_element_html' => "<div id='previewImg'>$preview</div>"
        ));
        $fieldset->addField('content', 'editor', array(
            'name'  => 'content',
            'label' => Mage::helper('dangnd_slider')->__('Content'),
        ));
        $fieldset->addField('link', 'text', array(
            'name'  => 'link',
            'label' => Mage::helper('dangnd_slider')->__('Link'),
        ));
        $fieldset->addField('visible', 'checkbox', array(
            'name'    => 'visible',
            'onclick' => 'this.value = this.checked ? 1 : 0;',
            'checked' => ($model->getVisible() == 1) ? 'true' : '',
            'label'   => Mage::helper('dangnd_slider')->__('Is Visible'),
        ));

        $form->addValues($model->getData());
        $form->setUseContainer(true);
        $form->setAction($this->getUrl('*/images/save'));

        $this->setForm($form);

        return parent::_prepareForm();
    }

    public function previewImg($image)
    {
        $link = Mage::getBaseUrl('media') . 'dangnd/slide/' . $image->getName();
        $html = "<div><img id='preview' src='{$link}' height='100px' /></div>";
//        $html .= "<div><input type='checkbox' value='{$image->getName()}' name='keep' /> Keep the old image.</div>";

        return $html;
    }
}
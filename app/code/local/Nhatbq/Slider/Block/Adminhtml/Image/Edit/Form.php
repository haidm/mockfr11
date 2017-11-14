<?php 
/**
* 
*/
class Nhatbq_Slider_Block_Adminhtml_Image_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
	
	 protected function _prepareForm()
    {
        $form = new Varien_Data_Form(
            array(
                'id' => 'edit_form',
                'action' => $this->getUrl('*/*/save'),
                'method' => 'post',
                'enctype' => 'multipart/form-data',
            ));
        $this->setForm($form);
        $model = Mage::registry('slider_image');
        $listSlider = Mage::registry('list_slider');
        $listImage = Mage::registry('list_image');
        $listId = array();
        foreach ($listImage as $item) {
            $listId[$item->id] = $item->slider_id;
        }
        $fieldset = $form->addFieldset('menuitem_form',
            array('legend' => 'Menu item infomation'));
        if ($model->getId()) {
            $fieldset->addField('link', 'image', array(
                'label' => Mage::helper('catalog')->__('Image'),
                'required' => false,
                'name' => 'image',
            ));
        } else {
            $fieldset->addField('link', 'file', array(
                'label' => Mage::helper('core')->__('Image'),
                'required' => true,
                'name' => 'image',
            ));
        }
        $fieldset->addField('text', 'textarea', array(
            'label' => Mage::helper('core')->__('text'),
            'required' => false,
            'name' => 'text',
        ));
        foreach ($listSlider as $item) {
            if (in_array($item->id, $listId)) {
                foreach ($listId as $key => $value) {
                    if ($item->id == $value) {
                        $fieldset->addField('listslider' . $key, 'checkbox', array(
                            'label' => $item->name,
                            'name' => 'listimage[]',
                            'value' => $key,
                            'checked' => 'true',
                        ));
                    }
                }
            } else {
                $fieldset->addField('listslider' . $item->id, 'checkbox', array(
                    'label' => $item->name,
                    'name' => 'listslide[]',
                    'value' => $item->id,
                ));
            }
        }
        if ($model->getId()) {
            $fieldset->addField('id', 'hidden',
                array(
                    'name' => 'id',
                    'label' => Mage::helper('tax')->__('Id')
                )
            );
        }
        $form->addValues($model->getData());
        $form->setUseContainer(true);
        return parent::_prepareForm();
    }
}
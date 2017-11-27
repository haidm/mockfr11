<?php

class SM_Slider_Block_Adminhtml_Slider_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    /**
     *
     * return Mage_Adminhtml_Block_Widget_Form
     */
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form(
            array(
                'id' => 'edit_form',
                'action' => $this->getUrl('*/*/save'),
            ));
        $this->setForm($form);
        $model = Mage::registry('slider');
        $listSliderImage = Mage::registry('slider_image');
        $listImage = Mage::registry('list_image');
        $listId = array();
        foreach ($listImage as $item) {
            $listId[$item->id] = $item->image_id;
        }
        $fieldset = $form->addFieldset('slider_form',
            array('legend' => 'Slider infomation'));

        $fieldset->addField('name', 'text',
            array(
                'label' => 'Slider Name',
                'name' => 'name',
                'class' => 'required-entry validate-alphanum',
                'required' => 'true',
            ));

        foreach ($listSliderImage as $item) {
            if (in_array($item->id,$listId)){
                foreach ($listId as $key => $value){
                    if ($item->id == $value){
                        $fieldset->addField('listimage'.$key, 'checkbox', array(
                            'label' => $item->name,
                            'name' => 'listimage[]',
                            'value' => $key,
                            'checked' => 'true',
                        ));
                    }
                }
            }
        }
        foreach ($listSliderImage as $item) {
            if (!in_array($item->id,$listId)){
                $fieldset->addField('newimage'.$item->id, 'checkbox', array(
                    'label' => $item->name,
                    'name' => 'newimage[]',
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
<?php
/**
 * Created by PhpStorm.
 * User: hungbui
 * Date: 29/10/2017
 * Time: 16:26
 */
/**
 * Adminhtml Slider Edit Form
 *
 * @category   Mage
 * @package    Mage_Adminhtml
 * @author     hungbd <hungbd@smartosc.com>
 */
class Hungbd_Slider_Block_Adminhtml_Slider_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
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
        $renderer = $this->getLayout()->createBlock('hungbd_slider/adminhtml_slider_renderer_formImage');
        $renderName = $this->getLayout()->createBlock('hungbd_slider/adminhtml_slider_renderer_TextRender');
        $fieldset = $form->addFieldset('slider_form',
            array('legend' => 'Slider infomation'));

        $fieldset->addField('name', 'text',
            array(
                'label' => 'Slider Name',
                'name' => 'name',
                'class' => 'required-entry validate-alphanum',
                'required' => 'true',
            ))->setRenderer($renderName);

        foreach ($listSliderImage as $item) {
            if (in_array($item->id,$listId)){
                foreach ($listId as $key => $value){
                    if ($item->id == $value){
                        $fieldset->addField("listimage$key", 'checkbox', array(
                            'label' => $item->link,
                            'name' => 'listimage[]',
                            'value' => $key,
                            'checked' => 'true',
                        ))->setRenderer($renderer);
                    }
                }
            }
            else{
                $fieldset->addField("newimage$item->id", 'checkbox', array(
                    'label' => $item->link,
                    'name' => 'newimage[]',
                    'value' => $item->id,
                ))->setRenderer($renderer);
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
//        $field = $fieldset->addField('test', 'text', array(
//            'label' => Mage::helper('core')->__('test'),
//            'name' => 'test',
//        ));
//        $renderer = $this->getLayout()->createBlock('hungbd_slider/adminhtml_slider_renderer_formImage');
//        $field->setRenderer($renderer);

        $form->addValues($model->getData());
        $form->setUseContainer(true);
        return parent::_prepareForm();
    }
}
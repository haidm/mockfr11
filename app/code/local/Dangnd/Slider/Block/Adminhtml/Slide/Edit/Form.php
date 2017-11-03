<?php
/**
 * Created by PhpStorm.
 * User: nddang196
 * Date: 26-10-2017
 * Time: 11:15 SA
 */

class Dangnd_Slider_Block_Adminhtml_Slide_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form([
            'id'     => 'edit_form',
            'action' => $this->getUrl('*/*/save'),
            ['id' => $this->getRequest()->getParam('id')],
            'method' => 'post',
            'enctype' => 'multipart/form-data'
        ]);
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}
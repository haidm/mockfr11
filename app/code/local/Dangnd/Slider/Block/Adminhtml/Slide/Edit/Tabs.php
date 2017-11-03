<?php
/**
 * Created by PhpStorm.
 * User: nddan
 * Date: 31-10-2017
 * Time: 2:02 CH
 */

class Dangnd_Slider_Block_Adminhtml_Slide_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('slider_slide_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('dangnd_slider')->__('Slide Options'));
    }

    protected function _beforeToHtml()
    {
        $this->addTab('general', [
            'label'   => Mage::helper('dangnd_slider')->__('General'),
            'title'   => Mage::helper('dangnd_slider')->__('General'),
            'content' => $this->getLayout()
                            ->createBlock('dangnd_slider/adminhtml_slide_edit_tab_general')
                            ->toHtml()
        ]);
        $this->addTab('images', [
            'label'   => Mage::helper('dangnd_slider')->__('Images'),
            'title'   => Mage::helper('dangnd_slider')->__('Images'),
            'content' => $this->getLayout()
                            ->createBlock('dangnd_slider/adminhtml_slide_edit_tab_images')
                            ->toHtml()
        ]);

        return parent::_beforeToHtml();
    }
}
<?php

class Hienth_MegaMenu_Block_Adminhtml_Menu_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('form_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('Hienth_MegaMenu')->__('Information Menu'));
    }

    protected function _beforeToHtml()
    {
        $menuId = Mage::registry('menuId');
        $menuType = Mage::registry('menuType');
        if(!$menuType){
        $this->addTab('form_section', array(
            'label' => Mage::helper('Hienth_MegaMenu')->__('Setting Menu'),
            'title' => Mage::helper('Hienth_MegaMenu')->__('Setting Menu'),
            'content' => $this->getLayout()->createBlock('Hienth_MegaMenu/adminhtml_Menu_edit_tab_form')->toHtml(),
        ));
        }

//        var_dump($menuType);die;
        if ($menuType == 'Custom Link') {
            $this->addTab('custom_link', array(
                'label' => "Custom Link",
                'title' => "Custom Link",
                'content' => $this->getLayout()
                    ->createBlock('Hienth_MegaMenu/adminhtml_Menu_edit_tab_customLink')
                    ->toHtml()
            ));
        }
        if ($menuType == 'Category Link') {
            $this->addTab('category_link', array(
                'label' => "Category Link",
                'title' => "Category Link",
                'content' => $this->getLayout()
                    ->createBlock('Hienth_MegaMenu/adminhtml_Menu_edit_tab_categoryLink')
                    ->toHtml()
            ));
        }
        if ($menuType == 'Product Link') {
            $this->addTab('product_link', array(
                'label' => "Product Link",
                'title' => "Product Link",
                'content' => $this->getLayout()
                    ->createBlock('Hienth_MegaMenu/adminhtml_Menu_edit_tab_productLink')
                    ->toHtml()
            ));
        }
        return parent::_beforeToHtml();
    }

}

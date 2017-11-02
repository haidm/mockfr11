<?php
/**
 * Created by PhpStorm.
 * User: hungbui
 * Date: 26/10/2017
 * Time: 14:21
 */
/**
 * Edit Tabs
 * @category    Hungbd
 * @package     Hungbd_Megamenu_Adminhtml
 * @author      hungbd <hungbd@smartosc.com>
 */
class Hungbd_MegaMenu_Block_Adminhtml_Menuitem_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('Menu_item_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('core')->__('Menu Item'));
    }

    protected function _beforeToHtml()
    {
        $newType = Mage::registry('menuitem_type');
        $editType = Mage::registry('menuitem_model');
//        var_dump($editType);die;
        $this->addTab('form_section', array(
            'label'     => "Menu item infomation",
            'title'     => "Menu item infomation",
            'content'   => $this->getLayout()
                ->createBlock('hungbd_megamenu/adminhtml_menuitem_edit_tab_form')
                ->toHtml()
        ));
        if ($newType == 'Custom link' || $editType->getType() == 'Custom link'){
            $this->addTab('custom_link', array(
                'label'     => "Custom Link",
                'title'     => "Custom Link",
                'content'   => $this->getLayout()
                    ->createBlock('hungbd_megamenu/adminhtml_menuitem_edit_tab_customLink')
                    ->toHtml()
            ));
        }

        if ($newType == 'Category link' || $editType->getType() == 'Category link') {
            $this->addTab('category_link', array(
                'label' => "Category Link",
                'title' => "Category Link",
                'content' => $this->getLayout()
                    ->createBlock('hungbd_megamenu/adminhtml_menuitem_edit_tab_categoryLink')
                    ->toHtml()
            ));
        }

        if ($newType == 'Product link' || $editType->getType() == 'Product link') {
            $this->addTab('product_link', array(
                'label' => "Product Link",
                'title' => "Product Link",
                'content' => $this->getLayout()
                    ->createBlock('hungbd_megamenu/adminhtml_menuitem_edit_tab_productLink')
                    ->toHtml()
            ));
        }

        return parent::_beforeToHtml();
    }
}
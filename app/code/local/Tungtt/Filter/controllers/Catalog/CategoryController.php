<?php

require_once Mage::getModuleDir('controllers', 'Mage_Catalog') . DS . 'CategoryController.php';
class Tungtt_Filter_Catalog_CategoryController extends Mage_Catalog_CategoryController
{
    public function viewAction()
    {
        $params = $this->getRequest()->getParams();
        $response = array();
        if ($category = $this->_initCatagory()) {
            $design = Mage::getSingleton('catalog/design');
            $settings = $design->getDesignSettings($category);
            // apply custom design
            if ($settings->getCustomDesign()) {
                $design->applyCustomDesign($settings->getCustomDesign());
            }
            Mage::getSingleton('catalog/session')->setLastViewedCategoryId($category->getId());
            $update = $this->getLayout()->getUpdate();
            $update->addHandle('default');
            if (!$category->hasChildren()) {
                $update->addHandle('catalog_category_layered_nochildren');
            }
            $this->addActionLayoutHandles();
            $update->addHandle($category->getLayoutUpdateHandle());
            $update->addHandle('CATEGORY_' . $category->getId());
            $this->loadLayoutUpdates();
            // apply custom layout update once layout is loaded
            if ($layoutUpdates = $settings->getLayoutUpdates()) {
                if (is_array($layoutUpdates)) {
                    foreach ($layoutUpdates as $layoutUpdate) {
                        $update->addUpdate($layoutUpdate);
                    }
                }
            }
            $this->generateLayoutXml()->generateLayoutBlocks();
            if ($params['isAjax'] == 1) {  //Check if it was an AJAX request
                // Generate New Layered Navigation Menu
                $viewPanel = $this->getLayout()->getBlock('catalog.leftnav')->toHtml();
                // Generate product list
                $productList = $this->getLayout()->getBlock('product_list')->toHtml();
                $response['status'] = 'SUCCESS';
                $response['viewpanel'] = $viewPanel;
                $response['productlist'] = $productList;
                $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($response));
                return;
            } else {
                // apply custom layout (page) template once the blocks are generated
                if ($settings->getPageLayout()) {
                    $this->getLayout()->helper('page/layout')->applyTemplate($settings->getPageLayout());
                }
                if ($root = $this->getLayout()->getBlock('root')) {
                    $root->addBodyClass('categorypath-' . $category->getUrlPath())
                        ->addBodyClass('category-' . $category->getUrlKey());
                }
                $this->_initLayoutMessages('catalog/session');
                $this->_initLayoutMessages('checkout/session');
                $this->renderLayout();
            }
        } elseif (!$this->getResponse()->isRedirect()) {
            if ($params['isAjax'] == 1)  //Check if it was an AJAX request
                $response['status'] = 'FAILURE';
            $this->_forward('noRoute');
        }
    }
}
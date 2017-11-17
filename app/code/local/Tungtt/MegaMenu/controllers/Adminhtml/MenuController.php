<?php

class Tungtt_MegaMenu_Adminhtml_MenuController extends Mage_Adminhtml_Controller_Action
{

    public function indexAction()
    {
        $this->_title($this->__('Menu Item'))->_title($this->__('Mega Menu'));
        $this->loadLayout()
            ->_setActiveMenu('tungtt/megamenu/index')
            ->_addBreadcrumb(Mage::helper('core')->__('Menu Item'), Mage::helper('core')->__('Menu Item'))
            ->_addBreadcrumb(Mage::helper('core')->__('Mega Menu'), Mage::helper('core')->__('Mega Menu'));
        $this->_addContent($this->getLayout()->createBlock('tungtt_megamenu/adminhtml_menuitem'))
            ->renderLayout();
    }

    /**
     * Add action
     * Render new form
     */
    public function newAction()
    {
        $this->loadLayout()
            ->_setActiveMenu('tungtt/megamenu/index')
            ->_addBreadcrumb(Mage::helper('core')->__('Menu Item'), Mage::helper('core')->__('Menu Item'))
            ->_addBreadcrumb(Mage::helper('core')->__('Mega Menu'), Mage::helper('core')->__('Mega Menu'));
        $this->_addBreadcrumb(
            Mage::helper('core')->__('Edit Menu Item'), Mage::helper('core')->__('New Menu Item'),
            Mage::helper('core')->__('Edit Menu Item'), Mage::helper('core')->__('New Menu Item'))
            ->_addContent($this->getLayout()
                ->createBlock('tungtt_megamenu/adminhtml_menuitem_new')
                ->setData('action', $this->getUrl('*/menu/save')))
            ->renderLayout();

    }

    /**
     * Edit action
     * Render Edit or New form
     */
    public function editAction()
    {
        $this->_title($this->__('Menu Item'))->_title($this->__('Mega Menu'));
        $itemType = $this->getRequest()->getParam('menuitem_type');
        $menuItemId = $this->getRequest()->getParam('id');
        $menuItemModel = Mage::getModel('tungtt_megamenu/menuitem');
        $menuItemList = Mage::getModel('tungtt_megamenu/menuitem')->getCollection();
        $categories = Mage::getModel('catalog/category')
            ->getCollection()
            ->addAttributeToSelect('name')
            ->addAttributeToFilter('level', array(2, 3, 4, 5, 6))
            ->addAttributeToSelect('is_active', 1)
            ->addUrlRewriteToResult();
        $productList = Mage::getModel('catalog/product')
            ->getCollection()
            ->addAttributeToSelect('name')
            ->addAttributeToFilter('status', 1)
            ->addAttributeToFilter('visibility', 4)
            ->setOrder('name', 'ASC');

        if ($menuItemId) {
            $menuItemModel->load($menuItemId);
            if (!$menuItemModel->getId()) {
                Mage::getSingleton('adminhtml/session')
                    ->addError(Mage::helper('core')->__('Menu item ko ton tai!'));
                $this->_redirect('*/*/');
                return;
            }
        }

        $this->_title($menuItemModel->getId() ? sprintf("Edit menu Item %s", $menuItemModel->getName()) : $this->__('New Menu Item'));

        Mage::register('menuitem_model', $menuItemModel);
        Mage::register('menuitem_type', $itemType);
        Mage::register('menuitem_list', $menuItemList);
        Mage::register('category', $categories);
        Mage::register('product_list', $productList);


        $this->loadLayout();
        $this->_setActiveMenu('tungtt/megamenu/index');
        $this->_addBreadcrumb('Mega menu', 'Mega menu');
        $this->_addBreadcrumb('Menu item', 'Menu item');
        $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
        $this->_addContent($this->getLayout()
            ->createBlock('tungtt_megamenu/adminhtml_menuitem_edit'))
            ->_addLeft($this->getLayout()
                ->createBlock('tungtt_megamenu/adminhtml_menuitem_edit_tabs'));
        $this->renderLayout();
    }

    /**
     * Save action
     * Save menuitem to database
     */

    public function saveAction()
    {
        $postData = $this->getRequest()->getParams();
        if ($this->getRequest()->getParam('parent_id') != 0) {
            $parentId = $this->getRequest()->getParam('parent_id');
            $parentLevel = Mage::getModel('tungtt_megamenu/menuitem')
                ->load($parentId)->getLevel();
            $level = $parentLevel + 1;
        } else {
            $parentId = 0;
            $level = 0;
        }
        if ($this->validate($postData) == 'true') {
            //save custom link
            if ($this->getRequest()->getParam('type') == 'Custom link') {
                $type = $this->getRequest()->getParam('type');
                $name = $this->getRequest()->getParam('name');
                $link = $this->getRequest()->getParam('link');
                $id = $this->getRequest()->getParam('id');
                $menuItemModel = Mage::getModel('tungtt_megamenu/menuitem')
                    ->setId($id)
                    ->setName($name)
                    ->setLevel($level)
                    ->setType($type)
                    ->setLink($link)
                    ->setParent_id($parentId);
                try {
                    $menuItemModel->save();

                    Mage::getSingleton('adminhtml/session')
                        ->addSuccess(Mage::helper('core')->__('The menu item has been saved.'));

                    if ($this->getRequest()->getParam('back')) {
                        return $this->_redirect('*/*/edit', array('id' => $menuItemModel->getId()));
                    }

                    return $this->_redirect('*/*/');
                } catch (Mage_Core_Exception $e) {
                    Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                } catch (Exception $e) {
                    Mage::getSingleton('adminhtml/session')
                        ->addError(Mage::helper('core')->__('An error occurred while saving this item.'));
                }
                Mage::getSingleton('adminhtml/session')->setRuleData($postData);
                $this->_redirectReferer();
            }

            //save category link
            if ($this->getRequest()->getParam('type') == 'Category link') {
                $type = $this->getRequest()->getParam('type');
                $categoryId = $this->getRequest()->getParam('category_id');
                $categoryModel = Mage::getModel('catalog/category');
                $categoryModel->load($categoryId);
                $name = $categoryModel->getName();
                $link = $categoryModel->getUrl();
                $id = $this->getRequest()->getParam('id');
                $menuItemModel = Mage::getModel('tungtt_megamenu/menuitem')
                    ->setId($id)
                    ->setName($name)
                    ->setLevel($level)
                    ->setType($type)
                    ->setLink($link)
                    ->setParent_id($parentId);
                try {
                    $menuItemModel->save();

                    Mage::getSingleton('adminhtml/session')
                        ->addSuccess(Mage::helper('core')->__('The menu item has been saved.'));

                    if ($this->getRequest()->getParam('back')) {
                        return $this->_redirect('*/*/edit', array('id' => $menuItemModel->getId()));
                    }

                    return $this->_redirect('*/*/');
                } catch (Mage_Core_Exception $e) {
                    Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                } catch (Exception $e) {
                    Mage::getSingleton('adminhtml/session')
                        ->addError(Mage::helper('core')->__('An error occurred while saving this item.'));
                }
                Mage::getSingleton('adminhtml/session')->setRuleData($postData);
                $this->_redirectReferer();

            }

            //save product link
            if ($this->getRequest()->getParam('type') == 'Product link') {
                $type = $this->getRequest()->getParam('type');
                $sku = $this->getRequest()->getParam('product_sku');
                $productModel = Mage::getModel('catalog/product');
                $productModel->load($productModel->getIdBySku($sku));
                $name = $productModel->getName();
                $link = $productModel->getProductUrl();
                $id = $this->getRequest()->getParam('id');
                $menuItemModel = Mage::getModel('tungtt_megamenu/menuitem')
                    ->setId($id)
                    ->setName($name)
                    ->setLevel($level)
                    ->setType($type)
                    ->setLink($link)
                    ->setParent_id($parentId);
                try {
                    $menuItemModel->save();

                    Mage::getSingleton('adminhtml/session')
                        ->addSuccess(Mage::helper('core')->__('The menu item has been saved.'));

                    if ($this->getRequest()->getParam('back')) {
                        return $this->_redirect('*/*/edit', array('id' => $menuItemModel->getId()));
                    }

                    return $this->_redirect('*/*/');
                } catch (Mage_Core_Exception $e) {
                    Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                } catch (Exception $e) {
                    Mage::getSingleton('adminhtml/session')
                        ->addError(Mage::helper('core')->__('An error occurred while saving this item.'));
                }
                Mage::getSingleton('adminhtml/session')->setRuleData($postData);
                $this->_redirectReferer();

            }
        } else {
            Mage::getSingleton('adminhtml/session')->setRuleData($postData);
            foreach ($this->validate($postData) as $error) {
                Mage::getSingleton('adminhtml/session')
                    ->addError(Mage::helper('core')->__($error));
            }
//            var_dump($postData);die;
            if ($postData['id']) {
                $this->_redirectReferer();
            } else {
                $this->_redirect('*/*/edit/menuitem_type/' . $postData['type']);
            }
        }
    }

    public function deleteAction()
    {
        $menuItemId = $this->getRequest()->getParam('id');
        try {
            Mage::getModel('tungtt_megamenu/menuitem')
                ->setId($menuItemId)
                ->delete()
                ->save();
            return $this->_redirect('*/*/');
        } catch (Mage_Core_Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        } catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')
                ->addError(Mage::helper('core')->__('An error occurred while saving this item.'));
        }
        $this->_redirectReferer();
    }

    /**
     * Validate function
     * @param array $data
     * @return true or array error
     */
    private function validate($data)
    {
        $errors = array();

        if ($data['type'] == 'Custom link' || $data['type'] == 'Product link' || $data['type'] == 'Category link') {

            if (!Zend_Validate::is($data['parent_id'], 'Regex', array('/^[0-9]+$/'))) {
                $errors[] = Mage::helper('core')->__('Not a valid parent id');
            }

            if ($data['type'] == 'Custom link') {

                if (!Zend_Validate::is($data['link'], 'Regex',
                    array('@^(https?|ftp)://[^\s/$.?#].[^\s]*$@'))) {
                    $errors[] = Mage::helper('core')->__('Not a valid url');
                }

                if (!Zend_Validate::is($data['name'], 'Regex', array('/^[a-z A-Z 0-9]{1,15}$/'))) {
                    $errors[] = Mage::helper('core')->__('Not a valid Name');
                }

                if ($data['id']) {
                    if (!Zend_Validate::is($data['id'], 'Regex', array('/^[0-9]+$/'))) {
                        $errors[] = Mage::helper('core')->__('Not a valid id');
                    }
                }
            }

            if ($data['type'] == 'Product link') {
                if (!Zend_Validate::is($data['product_sku'], 'Regex', array('/^[a-z A-z 0-9]{0,50}$/'))) {
                    $errors[] = Mage::helper('core')->__('Not a valid product sku');
                }
            }

            if ($data['type'] == 'Category link') {
                if (!Zend_Validate::is($data['category_id'], 'Regex', array('/^[0-9]+$/'))) {
                    $errors[] = Mage::helper('core')->__('Not a valid category id');
                }
            }

            if ($errors) {
                return $errors;
            } else {
                return 'true';
            }
        } else {
            $errors[] = Mage::helper('core')->__('Not a valid type');
            return $errors;
        }
    }

}
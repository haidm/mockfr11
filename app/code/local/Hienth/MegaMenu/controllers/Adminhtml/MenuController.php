<?php
class Hienth_MegaMenu_Adminhtml_MenuController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->_title($this->__('Mega Menu'))
            ->_title($this->__('Menu Item'));
        $this->loadLayout()
            ->_setActiveMenu('mega')
            ->_addBreadcrumb(Mage::helper('core')->__('Mega Menu'), Mage::helper('core')->__('Mega Menu'))
            ->_addBreadcrumb(Mage::helper('core')->__('Menu Item'), Mage::helper('core')->__('Menu Item'))
        ;
        $this->_addContent($this->getLayout()->createBlock('Hienth_MegaMenu/adminhtml_menu'))
            ->renderLayout();
        return $this;
    }

    public function newAction()
    {
        $this->_forward('edit');
    }

    public function editAction()
    {
        $this->_title($this->__('Mega Menu'))
            ->_title($this->__('Edit Menu'));
        $menuModel  = Mage::getModel('Hienth_MegaMenu/menu');
        $menuId  = $this->getRequest()->getParam('id');
        $menuType = $this->getRequest()->getParam('menu_type');
        $menuParent = $this->getRequest()->getParam('menu_id');
        Mage::register('menuParent', $menuParent);
        Mage::register('menumodel', $menuModel);
        Mage::register('menuType', $menuType);
//        Mage::register('menuCategory', $menuCategory);
//        Mage::register('menuProduct', $menuProduct);
        Mage::register('menuId', $menuId);
        if ($menuId) {
            $menuModel->load($menuId);
            if (!$menuModel->getId()) {
                Mage::getSingleton('adminhtml/session')
                    ->addError(Mage::helper('core')->__('Menu không tồn tại!'));
                $this->_redirect('*/*/');
                return;
            }
        }
        $this->_title($menuModel->getId() ? sprintf("Edit Menu %s", $menuModel->getName()) : $this->__('New Menu'));
        $this->loadLayout()
            ->_setActiveMenu('mega/categoryitem')
            ->_addBreadcrumb(Mage::helper('core')->__('Mega Menu'), Mage::helper('core')->__('Mega Menu'))
            ->_addBreadcrumb(Mage::helper('core')->__('Menu Item'), Mage::helper('core')->__('Menu Item'))
        ;
        $this->_addBreadcrumb(
            $menuId ? Mage::helper('core')->__('Edit Menu') :  Mage::helper('core')->__('New Menu'),
            $menuId ?  Mage::helper('core')->__('Edit Menu') :  Mage::helper('core')->__('New Menu'))
            ->_addContent($this->getLayout()->createBlock('Hienth_MegaMenu/adminhtml_menu_edit')
            ->setData('action', $this->getUrl('*/menu/save')))
            ->_addLeft($this->getLayout()->createBlock('Hienth_MegaMenu/adminhtml_menu_edit_tabs'))
            ->renderLayout();
    }
    public function saveAction()
    {
        $postData = $this->getRequest()->getParams();
//        var_dump($postData['custom_link']);die;
        if($postData['menuParent'] != 0)
        {
            $parentlevel = Mage::getModel('Hienth_MegaMenu/menu')->load($postData['menuParent'])->getLevel();
            $levelsub = $parentlevel + 1;
        }
        else{
            $levelsub = 0;
            $postData['menuParent'] = 0;
        }
        if($this->validate($postData) == 'true')
        {
            //add and save category link
            if($postData['menuType'] == 'Category Link')
            {
                $modelCate = Mage::getModel('catalog/category')->load($postData['category_id']);
                $menuName = $modelCate->getName();
                $menuLink = $modelCate->getUrl();
                $modelMenu = Mage::getModel('Hienth_MegaMenu/menu')
                    ->setType($postData['menuType'])
                    ->setParent_id($postData['menuParent'])
                    ->setLevel($levelsub)
                    ->setName($menuName)
                    ->setLink($menuLink);
                if($postData['menuId'])
                {
                    $modelMenu->setId($postData['menuId']);
                }
                try {
                    $modelMenu->save();
                    Mage::getSingleton('adminhtml/session')
                        ->addSuccess(Mage::helper('Hienth_MegaMenu')->__('The menu item has been saved.'));
                    if ($this->getRequest()->getParam('back')) {
                        return $this->_redirect('*/*/edit', array('id' => $modelMenu->getId()));
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
            //add and save product link
            if($postData['menuType'] == 'Product Link')
            {
                $modelPro = Mage::getModel('catalog/product')->load($postData['product_id']);
                $menuName = $modelPro->getName();
                $menuLink = $modelPro->getProductUrl();
//                var_dump($postData['menuParent']);die;
                $modelMenu = Mage::getModel('Hienth_MegaMenu/menu')
                    ->setType($postData['menuType'])
                    ->setParent_id($postData['menuParent'])
                    ->setLevel($levelsub)
                    ->setName($menuName)
                    ->setLink($menuLink);
                if($postData['menuId'])
                {
                    $modelMenu->setId($postData['menuId']);
                }
                try {
                    $modelMenu->save();
                    Mage::getSingleton('adminhtml/session')
                        ->addSuccess(Mage::helper('Hienth_MegaMenu')->__('The menu item has been saved.'));
                    if ($this->getRequest()->getParam('back')) {
                        return $this->_redirect('*/*/edit', array('id' => $modelMenu->getId()));
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

            //add and save custom link
            if($postData['menuType'] == 'Custom Link')
            {
                $modelMenu = Mage::getModel('Hienth_MegaMenu/menu')
                    ->setType($postData['menuType'])
                    ->setParent_id($postData['menuParent'])
                    ->setLevel($levelsub)
                    ->setName($postData['name'])
                    ->setLink($postData['link']);
                if($postData['menuId'])
                {
                    $modelMenu->setId($postData['menuId']);
                }
                try {
                    $modelMenu->save();
                    Mage::getSingleton('adminhtml/session')
                        ->addSuccess(Mage::helper('core')->__('The menu item has been saved.'));
                    if ($this->getRequest()->getParam('back')) {
                        return $this->_redirect('*/*/edit', array('id' => $modelMenu->getId()));
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
        }
        else
        {
//            var_dump();die;
            Mage::getSingleton('adminhtml/session')
                ->addError($this->validate($postData)[0]);
            $this->_redirect('*/*/');
        }
    }
    public function  validate($data)
    {
        $errors = array();
        $helper = Mage::helper('core');
        if($data['menuType'] == 'Category Link'||$data['menuType'] == 'Custom Link'||$data['menuType'] == 'Product Link')
        {
            if (!Zend_Validate::is($data['menuParent'], 'Regex',array('/^[0-9]+$/'))) {
                $errors[] = $helper->__('Không đúng kiểu parent id.');
            }
            if($data['menuType'] == 'Category Link')
            {
                if(!Zend_Validate::is($data['category_id'],'Regex',array('/^[0-9]+$/')))
                {
                    $errors[] = $helper->__('Không đúng kiểu category id.');
                }
            }
            if($data['menuType'] == 'Product Link')
            {
                if(!Zend_Validate::is($data['product_id'],'Regex',array('/^[0-9]+$/')))
                {
                    $errors[] = $helper->__('Không đúng kiểu product id.');
                }
            }
            if($data['menuType'] == 'Custom Link')
            {
                if(!Zend_Validate::is($data['link'],'Regex',array('@^(https?|ftp)://[^\s/$.?#].[^\s]*$@')))
                {
                    $errors[] = $helper->__('Không đúng kiểu custom link.');
                }
                if(!Zend_Validate::is($data['name'],'Regex',array('/^[a-z A-Z 0-9]{3,50}$/')))
                {
                    $errors[] = $helper->__('Không đúng kiểu custom name.');
                }
            }
        }
        else
        {
            $errors[] = $helper->__('Không đúng kiểu menu.');
        }
        if($errors){
            return $errors;
        }
        else
        {
            return 'true';
        }

    }
    public function deleteAction()
    {
        $menuId = $this->getRequest()->getParam('id');
        $menuParent  = Mage::getModel('Hienth_MegaMenu/menu')->load($menuId)->getParent_id();
        if($menuParent > 0)
        {
            Mage::getSingleton('adminhtml/session')
                ->addError(Mage::helper('Hienth_MegaMenu')->__('Không thể xóa phần tử có parent id.'));
            $this->_redirect('*/*/');
        }
        else
        {
            try {
                Mage::getModel('Hienth_MegaMenu/menu')
                    ->setId($menuId)
                    ->delete();
                Mage::getSingleton('adminhtml/session')
                    ->addSuccess(Mage::helper('core')->__('The menu item has been deleted.'));
                return $this->_redirect('*/*/');
            } catch (Mage_Core_Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')
                    ->addError(Mage::helper('Hienth_MegaMenu')->__('An error occurred while saving this item.'));
            }
            $this->_redirectReferer();
        }
    }
}
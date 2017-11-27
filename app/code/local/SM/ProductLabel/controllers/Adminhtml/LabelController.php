<?php

class SM_ProductLabel_Adminhtml_ImageController extends Mage_Adminhtml_Controller_Action
{

    public function indexAction()
    {
        $this->_title($this->__('Catalog'))->_title($this->__('Label Manager'));
        $this->loadLayout()
            ->_setActiveMenu('sm/productLabel')
            ->_addBreadcrumb(Mage::helper('core')->__('Menu Item'), Mage::helper('core')->__('Menu Item'));
             $this->_addContent($this->getLayout()->createBlock('sm_productLabel/adminhtml_label'))
            ->renderLayout();
    }


//    public function editAction()
//    {
//
//        $this->_title($this->__('Menu Item'))->_title($this->__('Slider Image'));
//        $sliderImage = $this->getRequest()->getParam('id');
//        $sliderImageModel = Mage::getModel('sm_slider/image');
//        $sliderModel = Mage::getModel('sm_slider/slider')->getCollection();
//        if ($sliderImage) {
//            $sliderImageModel->load($sliderImage);
//            $listImage = Mage::getModel('sm_slider/listimage')
//                ->getCollection()
//                ->join(array('slider' => 'sm_slider/slider'),
//                    'main_table.slider_id=slider.id',
//                    array('name'))
//                ->addFilter('image_id', $sliderImage);
//            Mage::register('list_image', $listImage);
//            if (!$sliderImageModel->getId()) {
//                Mage::getSingleton('adminhtml/session')
//                    ->addError(Mage::helper('core')->__('Image ko ton tai!'));
//                $this->_redirect('*/*/');
//                return;
//            }
//        }
//        $this->_title($sliderImageModel->getId() ? sprintf("Edit Slider Image %s", $sliderImageModel->getName()) : $this->__('New Slider Image'));
//
//        Mage::register('slider_image', $sliderImageModel);
//        Mage::register('list_slider', $sliderModel);
//
//
//        $this->loadLayout();
//        $this->_setActiveMenu('sm/slider');
//        $this->_addBreadcrumb('Slider', 'Slider');
//        $this->_addBreadcrumb('Image', 'Image');
//        $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
//        $this->_addContent($this->getLayout()
//            ->createBlock('sm_slider/adminhtml_image_edit'));
//        $this->renderLayout();
//    }
//
//
//    public function saveAction()
//    {
//        $postData = $this->getRequest()->getParams();
//        if ($this->validate($postData) == 'true') {
//
//            if (!$postData) {
//                return $this->getResponse()->setRedirect($this->getUrl('*/image'));
//            }
//
//            $imageId = $this->getRequest()->getParam('id');
//            $oldListImage = $this->getRequest()->getParam('listimage');
//            $newListImage = $this->getRequest()->getParam('listslide');
//            $imageText = $this->getRequest()->getParam('text');
//            $image = Mage::getModel('sm_slider/image');
//
//            if (!empty($_FILES['image']['name']) || $_FILES['image']['name']) {
//                try {
//                    $path = Mage::getBaseDir('media') . DS . 'sm' . DS;
//                    unlink($path.Mage::getModel('sm_slider/image')->load($imageId)->getName());
//                    $newDir = 'sm';
//                    $uploader = new Varien_File_Uploader('image');
//                    $uploader->setAllowedExtensions(array('jpg', 'jpeg', 'gif', 'png'));
//                    $uploader->setAllowCreateFolders(true);
//                    $uploader->setAllowRenameFiles(true);
//                    $uploader->setFilesDispersion(false);
//                    $new_dirPath = Mage::getBaseDir('media') . DS . $newDir;
//                    if (!file_exists($new_dirPath)) {
//                        mkdir($new_dirPath, 0777);
//                    }
//                    $path = Mage::getBaseDir('media') . DS . $newDir . DS;
//                    $uploader->save($path, $_FILES['image']['name']);
//                    $fileName = $uploader->getUploadedFileName();
//                    $imageLink = Mage::getBaseUrl("media") . DS . $newDir . DS . $fileName;
//                } catch (Exception $e) {
//                    Mage::getSingleton('adminhtml/session')->addError(Mage::helper('core')->__($fileName . " Invalid file format"));
//                    $this->_redirectReferer();
//                }
//            }
//
//            $image->setId($imageId)->setName($fileName)->setLink($imageLink)->setText($imageText);
//            try {
//                $image->save();
//                if ($imageId) {
//                    if ($oldListImage) {
//                        $listImageInList = Mage::getModel('sm_slider/listimage')
//                            ->getCollection()
//                            ->addFilter('image_id', $imageId);
//                        foreach ($listImageInList as $item) {
//                            if (!in_array($item->id, $oldListImage)) {
//                                $id[] = $item->id;
//                            }
//                        }
//                        $deleteListImage = Mage::getModel('sm_slider/listimage')
//                            ->getCollection()
//                            ->addFieldToFilter('id', $id);
//                        foreach ($deleteListImage as $item) {
//                            $item->delete();
//                        }
//                    }
//                    if ($newListImage) {
//                        foreach ($newListImage as $item) {
//                            Mage::getModel('sm_slider/listimage')
//                                ->setImage_id($imageId)
//                                ->setSlider_id($item)
//                                ->save();
//                        }
//                    }
//
//                } else {
//                    $lastId = Mage::getModel('sm_slider/image')->getCollection()->getLastItem();
//                    if ($newListImage) {
//                        foreach ($newListImage as $item) {
//                            Mage::getModel('sm_slider/listimage')
//                                ->setImage_id($lastId->id)
//                                ->setSlider_id($item)
//                                ->save();
//                        }
//                    }
//                }
//
//                Mage::getSingleton('adminhtml/session')
//                    ->addSuccess(Mage::helper('core')->__('The Image has been saved.'));
//
//                if ($this->getRequest()->getParam('back')) {
//                    return $this->_redirect('*/*/edit', array('id' => $image->getId()));
//                }
//
//                return $this->_redirect('*/*/');
//            } catch (Mage_Core_Exception $e) {
//                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
//            } catch (Exception $e) {
//                Mage::getSingleton('adminhtml/session')
//                    ->addError(Mage::helper('core')->__('An error occurred while saving this item.'));
//            }
//
//            Mage::getSingleton('adminhtml/session')->setRuleData($postData);
//            $this->_redirectReferer();
//
//        } else {
//            Mage::getSingleton('adminhtml/session')->setRuleData($postData);
//            foreach ($this->validate($postData) as $error) {
//                Mage::getSingleton('adminhtml/session')
//                    ->addError(Mage::helper('core')->__($error));
//            }
//            $this->_redirectReferer();
//        }
//    }
//
//
//    public function deleteAction()
//    {
//        $imageId = $this->getRequest()->getParam('id');
//        if (!$imageId) {
//            Mage::getSingleton('adminhtml/session')
//                ->addError(Mage::helper('core')->__('Image ko ton tai!'));
//            return $this->_redirect('*/*/');
//        }
//
//        try {
//            $image = Mage::getModel('sm_slider/image')->load($imageId);
//            $fileName = $image->getName();
//            $path = Mage::getBaseDir('media') . DS . 'sm' . DS;
//            unlink($path.$fileName);
//            $image->delete();
//            Mage::getSingleton('adminhtml/session')
//                ->addSuccess(Mage::helper('core')->__('The Image has been deleted.'));
//        } catch (Exception $e) {
//            Mage::getSingleton('adminhtml/session')
//                ->addError(Mage::helper('core')->__('An error occurred while deleting this Image.'));
//        }
//        $this->_redirect('*/*/');
//    }
//
//
//    public function newAction()
//    {
//        $this->_forward('edit');
//    }
//
//
//    private function validate($data)
//    {
//        $errors = array();
//        if ($data['text']){
//            if (!Zend_Validate::is($data['text'], 'Regex', array('/^[a-zA-Z0-9\s\.\?\!]{1,100}$/'))) {
//                $errors[] = Mage::helper('core')->__('Not a valid Text');
//            }
//        }
//
//        if ($data['id']) {
//            if (!Zend_Validate::is($data['id'], 'Regex', array('/^[0-9]+$/'))) {
//                $errors[] = Mage::helper('core')->__('Not a valid id');
//            }
//        }
//
//        if ($data['listimage']) {
//            foreach ($data['listimage'] as $item) {
//                if (!Zend_Validate::is($item, 'Regex', array('/^[0-9]+$/'))) {
//                    $errors[] = Mage::helper('core')->__('Not a valid slider');
//                }
//            }
//        }
//
//        if ($data['listslider']) {
//            foreach ($data['listslider'] as $item) {
//                if (!Zend_Validate::is($item, 'Regex', array('/^[0-9]+$/'))) {
//                    $errors[] = Mage::helper('core')->__('Not a valid slider');
//                }
//            }
//        }
//
//        if ($errors) {
//            return $errors;
//        } else {
//            return 'true';
//        }
//    }
}
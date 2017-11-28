<?php
class Hienth_Slider_Adminhtml_ImageController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->_title($this->__('Slider'))
            ->_title($this->__('Image'));
        $this->loadLayout()
            ->_setActiveMenu('mega')
            ->_addBreadcrumb(Mage::helper('Hienth_Slider')->__('Slider'), Mage::helper('Hienth_Slider')->__('Slider'))
            ->_addBreadcrumb(Mage::helper('Hienth_Slider')->__('Image'), Mage::helper('Hienth_Slider')->__('Image'))
        ;
        $this->_addContent($this->getLayout()->createBlock('Hienth_Slider/adminhtml_image'))
            ->renderLayout();
        return $this;
    }
    public function newAction()
    {
        $this->_forward('edit');
    }
    public function editAction()
    {
        $this->_title($this->__('Image Slider'))
            ->_title($this->__('Edit Image'));
        $imageId  = $this->getRequest()->getParam('id');
        $imageModel  = Mage::getModel('Hienth_Slider/image');
        $modelImage = Mage::getModel('Hienth_Slider/image')->load($imageId);
        Mage::register('modelImage',$modelImage);
        Mage::register('imageId', $imageId);
        if ($imageId) {
            $imageModel->load($imageId);
            if (!$imageModel->getId()) {
                Mage::getSingleton('adminhtml/session')
                    ->addError(Mage::helper('core')->__('Image không tồn tại!'));
                $this->_redirect('*/*/');
                return;
            }
        }
        $this->_title($imageModel->getId() ? sprintf("Edit Image %s", $imageModel->getName()) : $this->__('New Image'));
        $this->loadLayout()
            ->_setActiveMenu('mega')
            ->_addBreadcrumb(Mage::helper('core')->__('Image Slider'), Mage::helper('core')->__('Image Slider'))
            ->_addBreadcrumb(Mage::helper('core')->__('Image Item'), Mage::helper('core')->__('Image Item'))
        ;
        $this->_addBreadcrumb(
            $imageId ? Mage::helper('core')->__('Edit Image') :  Mage::helper('core')->__('New Image'),
            $imageId ?  Mage::helper('core')->__('Edit Image') :  Mage::helper('core')->__('New Image'))
            ->_addContent($this->getLayout()->createBlock('Hienth_Slider/adminhtml_image_edit')
                ->setData('action', $this->getUrl('*/image/save')))
            ->renderLayout();
    }
    public function saveAction()
    {
        $postdata = $this->getRequest()->getParams();
//        var_dump($_FILES['image']['name']);die;
        if($_FILES['image']['name'] == ''){
            if(!$postdata['imageId'])
            {
                Mage::getSingleton('adminhtml/session')
                    ->addError(Mage::helper('Hienth_Slider')->__('Chưa thêm ảnh.'));
                $this->_redirect('*/*/');
                return;
            }
            else
            {
                if($postdata['is_enabled'])
                {
                    Mage::getSingleton('adminhtml/session')
                        ->addError(Mage::helper('Hienth_Slider')->__('Phải thêm ảnh.'));
                    $this->_redirect('*/*/');
                    return;
                }
                else
                {
                    $nameImage = $postdata['img'];
                }
            }
        }
        else{
            if($postdata['is_enabled'])
            {
                $i = $postdata['img'];
                $p = Mage::getBaseDir('media'). DS .'hienth/image'. DS;
                unlink($p.$i);
            }
            $strName = str_replace(' ','',$_FILES['image']['name']);
            $strName = str_replace('(','_',$_FILES['image']['name']);
            $strName = str_replace(')','_',$_FILES['image']['name']);
            $uploader = new Varien_File_Uploader('image');
            $uploader->setAllowedExtensions(array('jpg', 'jpeg', 'gif', 'png'));
            $path = Mage::getBaseDir('media') . DS .'hienth/image'. DS;
            $destFile = $path . $strName;
            $filename = $uploader->getNewFileName($destFile);
            $uploader->save($path, $filename);
            $nameImage = $filename;
        }
        $model = Mage::getModel('Hienth_Slider/image');
        if($this->validate($postdata) == 'true')
        {
            $model->setName($nameImage)
                ->setLink($postdata['link'])
                ->setText($postdata['text']);
            if($postdata['imageId']){
                $model->setId($postdata['imageId']);
            }
            try {
                $model->save();
                Mage::getSingleton('adminhtml/session')
                    ->addSuccess(Mage::helper('Hienth_Slider')->__('The menu item has been saved.'));
                if ($this->getRequest()->getParam('back')) {
                    return $this->_redirect('*/*/edit', array('id' => $model->getId()));
                }
                return $this->_redirect('*/*/');
            } catch (Mage_Core_Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')
                    ->addError(Mage::helper('core')->__('An error occurred while saving this item.'));
            }
            Mage::getSingleton('adminhtml/session')->setRuleData($postdata);
            $this->_redirectReferer();
        }
        else
        {
            Mage::getSingleton('adminhtml/session')
                ->addError($this->validate($postdata)[0]);
            $this->_redirect('*/*/');
        }

    }
    public function deleteAction()
    {
        $imageId = $this->getRequest()->getParam('id');
        $modelSlider = Mage::getModel('Hienth_Slider/slider')->getCollection();
        foreach ($modelSlider as $item)
        {
            $id = explode('-',$item->list_image);
            if(in_array($imageId,$id))
            {
                Mage::getSingleton('adminhtml/session')
                    ->addError(Mage::helper('Hienth_Slider')->__('Không thể xóa phần tử còn tồn tại trong slider.'));
                $this->_redirect('*/*/');
                return;
            }
        }
        {
            try {
                $imageModel = Mage::getModel('Hienth_Slider/image')->load($imageId);
                $image = $imageModel->getName();
                $path = Mage::getBaseDir('media'). DS .'hienth/image'. DS;
                unlink($path.$image);
                $imageModel->delete();
                Mage::getModel('Hienth_Slider/image')
                    ->setId($imageId)
                    ->delete();
                Mage::getSingleton('adminhtml/session')
                    ->addSuccess(Mage::helper('core')->__('The menu item has been deleted.'));
                return $this->_redirect('*/*/');
            } catch (Mage_Core_Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')
                    ->addError(Mage::helper('Hienth_Slider')->__('An error occurred while saving this item.'));
            }
            $this->_redirectReferer();
        }
    }
    public function  validate($data)
    {
        $errors = array();
        $helper = Mage::helper('core');
        if($data['link'] != ''){
            if(!Zend_Validate::is($data['link'],'Regex',array('@^(https?|ftp)://[^\s/$.?#].[^\s]*$@')))
            {
                $errors[] = $helper->__('Không đúng kiểu link.');
            }
        }
        if(!Zend_Validate::is($data['text'],'Regex',array('/^[a-z A-Z 0-9]*$/')))
        {
            $errors[] = $helper->__('Không đúng kiểu text.');
        }
        if(!Zend_Validate::is($data['imageId'],'Regex',array('/^[0-9]+$/')))
        {
            $errors[] = $helper->__('Không đúng kiểu ID.');
        }
        if($errors){
            return $errors;
        }
        else
        {
            return 'true';
        }

    }
}
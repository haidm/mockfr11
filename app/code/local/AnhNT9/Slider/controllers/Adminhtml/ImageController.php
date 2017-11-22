<?php

/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 10/31/2017
 * Time: 3:41 PM
 */
class AnhNT9_Slider_Adminhtml_ImageController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->_title($this->__('Slider'))
            ->_title($this->__('Image Manager'));

        $this->loadLayout()
            ->_setActiveMenu('image/image')
            ->_addBreadcrumb(Mage::helper('anhnt9_slider')->__('Slider'), Mage::helper('anhnt9_slider')->__('Slider'))
            ->_addBreadcrumb(Mage::helper('anhnt9_slider')->__('Image Manager'), Mage::helper('anhnt9_slider')->__('Image Manager'));

        $this->_addContent($this->getLayout()->createBlock('anhnt9_slider/adminhtml_image'))
            ->renderLayout();
        return $this;
    }

    /**
     * Edit action
     */
    public function editAction()
    {
        $this->_title($this->__('Slider'))
            ->_title($this->__('Image Manager'));

        $image_id = $this->getRequest()->getParam('image_id');
        $imageModel = Mage::getModel('anhnt9_slider/image');
        if ($image_id) {
            $imageModel->load($image_id);
            if (!$imageModel->getId()) {
                Mage::getSingleton('adminhtml/session')
                    ->addError(Mage::helper('anhnt9_slider')->__('Image ko ton tai!'));
                $this->_redirect('*/*/');
                return;
            }
        }


        $this->_title($imageModel->getId() ? sprintf("Edit image %s", $imageModel->getName()) : $this->__('New Image'));

        Mage::register('imagemodel', $imageModel);

        $this->loadLayout()
            ->_setActiveMenu('slider/slider')
            ->_addBreadcrumb(Mage::helper('anhnt9_slider')->__('Slider'), Mage::helper('anhnt9_slider')->__('Slider'))
            ->_addBreadcrumb(Mage::helper('anhnt9_slider')->__('Slider Manager'), Mage::helper('anhnt9_slider')->__('Image Manager'));

        $this->_addBreadcrumb(
            $image_id ? Mage::helper('anhnt9_slider')->__('Edit image') : Mage::helper('anhnt9_slider')->__('New Image'),
            $image_id ? Mage::helper('anhnt9_slider')->__('Edit image') : Mage::helper('anhnt9_slider')->__('New Image'))
            ->_addContent($this->getLayout()->createBlock('anhnt9_slider/adminhtml_image_edit')
                ->setData('action', $this->getUrl('*/image/save')))
            ->renderLayout();
    }

    /**
     * Redirect to edit action
     */
    public function newAction()
    {
        $this->_forward('edit');
    }

    /**
     * Save action
     *
     * @return Mage_Core_Controller_Response_Http|Mage_Core_Controller_Varien_Action
     */
    public function saveAction()
    {
        $postData = $this->getRequest()->getParams();

        if (!$postData) {
            return $this->getResponse()->setRedirect($this->getUrl('*/image'));
        }

        if (!empty($_FILES['name_image']['name'])) {
            try {
                $newDir = 'my_slider';
                $uploader = new Varien_File_Uploader('name_image');
                $uploader->setAllowedExtensions(array('jpg', 'jpeg', 'gif', 'png'));
                $uploader->setAllowCreateFolders(true);
                $uploader->setAllowRenameFiles(true);
                $uploader->setFilesDispersion(false);

                $new_dirPath = Mage::getBaseDir('media') . DS . $newDir;

                if (!file_exists($new_dirPath)) {
                    mkdir($new_dirPath, 0777);
                }
                $path = Mage::getBaseDir('media') . DS . $newDir . DS;
                $uploader->save($path, $_FILES['name_image']['name']);
                $fileName = $uploader->getUploadedFileName();
                $_imgUrl = Mage::getBaseUrl("media") . $newDir . '/' . $fileName;

            } catch (Exception $e) {
                $fileType = "Invalid file format";
            }
        }else{
            $fileType = "Image is required";
        }
        if ($fileType == 'Invalid file format') {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('anhnt9_slider')->__($fileName . " Invalid file format"));
            $this->_redirect('*/*/');
            return;
        }
        if ($fileType == 'Image is required') {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('anhnt9_slider')->__($fileName . " Image is required"));
            $this->_redirect('*/*/');
            return;
        }

        //modify image and delete file image if delete image to checkbox
        if (isset($postData['name_image']['delete']) && $postData['name_image']['delete'] == 1) {
            try {
                $img_path = $postData['name_image']['value'];
                $dirImg = Mage::getBaseDir() . str_replace("/", DS, strstr($img_path, '/media'));
                if (!file_exists($dirImg)) {
                    Mage::getSingleton('adminhtml/session')
                        ->addError(Mage::helper('anhnt9_slider')->__('Image ko ton tai!'));
                    return;
                }
                unlink($dirImg);
            } catch (Exception $exc) {
                echo $exc->getTraceAsString();
            }
        }
        //save image to database
        $postData['name_image'] = $_imgUrl;
        if ($postData['image_id']) {
            $image = Mage::getModel('anhnt9_slider/image');
            $image->setData($postData);
            if (count($postData['sl_id']) > 1) {
                Mage::getSingleton('adminhtml/session')
                    ->addError(Mage::helper('anhnt9_slider')->__('You only select a slider'));
                return $this->_redirect('*/*/edit', array('image_id' => $image->getId()));
            } else {
                try {
                    $image->save();

                    Mage::getSingleton('adminhtml/session')
                        ->addSuccess(Mage::helper('anhnt9_slider')->__('The image has been saved.'));

                    if ($this->getRequest()->getParam('back')) {
                        return $this->_redirect('*/*/edit', array('image_id' => $image->getId()));
                    }

                    return $this->_redirect('*/*/');
                } catch (Mage_Core_Exception $e) {
                    Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                } catch (Exception $e) {
                    Mage::getSingleton('adminhtml/session')
                        ->addError(Mage::helper('anhnt9_slider')->__('An error occurred while saving this image.'));
                }

                Mage::getSingleton('adminhtml/session')->setRuleData($postData);
                $this->_redirectReferer();
            }
        }

        //Add image and multi_select slider
        $arrData = array();
        if (isset($postData['sl_id'])) {
            foreach ($postData['sl_id'] as $key => $item) {
                $postData['sl_id'] = $item;
                $arrData[$key] = $postData;
            }
            try {
                foreach ($arrData as $data) {
                    $imageMutiselect = Mage::getModel('anhnt9_slider/image');
                    $imageMutiselect->setData($data);
                    $imageMutiselect->save();
                }
                Mage::getSingleton('adminhtml/session')
                    ->addSuccess(Mage::helper('anhnt9_slider')->__('The image has been saved.'));

                if ($this->getRequest()->getParam('back')) {
                    return $this->_redirect('*/*/edit', array('image_id' => $imageMutiselect->getId()));
                }

                return $this->_redirect('*/*/');
            } catch (Mage_Core_Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')
                    ->addError(Mage::helper('anhnt9_slider')->__('An error occurred while saving this image.'));
            }

            Mage::getSingleton('adminhtml/session')->setRuleData($data);
            $this->_redirectReferer();
        }
    }

    /**
     * Delete slider
     */
    public function deleteAction()
    {
        $image_id = $this->getRequest()->getParam('image_id');
        //get list data by id image
        $getDataById = Mage::getModel('anhnt9_slider/image')->getCollection()->addFieldToFilter('image_id', $image_id)->getData();
        try {
            $img_path = $getDataById[0]['name_image'];
            $dirImg = Mage::getBaseDir() . str_replace("/", DS, strstr($img_path, '/media'));

            if (!file_exists($dirImg)) {
                Mage::getSingleton('adminhtml/session')
                    ->addError(Mage::helper('anhnt9_slider')->__('Image ko ton tai!'));
                return $this->_redirect('*/*/');
            }
            //delete file image
            unlink($dirImg);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        if (!$image_id) {
            Mage::getSingleton('adminhtml/session')
                ->addError(Mage::helper('anhnt9_slider')->__('Slider ko ton tai!'));
            return $this->_redirect('*/*/');
        }

        try {
            $Image = Mage::getModel('anhnt9_slider/image');
            $Image->setId($image_id);
            $Image->delete();
            Mage::getSingleton('adminhtml/session')
                ->addSuccess(Mage::helper('anhnt9_slider')->__('The slider has been deleted.'));
        } catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')
                ->addError(Mage::helper('anhnt9_slider')->__('An error occurred while deleting this slider.'));
        }
        $this->_redirect('*/*/');
    }

    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('admin');
    }

    public function validate(){
        $errors = array();

        $helper = Mage::helper('customer');

        if (!Zend_Validate::is($this->getName_image(), 'NotEmpty')) {
            $errors[] = $helper->__('Review summary can\'t be empty');
        }

        if (!Zend_Validate::is($this->getSl_id(), 'NotEmpty')) {
            $errors[] = $helper->__('Nickname can\'t be empty');
        }

        if (!Zend_Validate::is($this->getDescreption(), 'NotEmpty')) {
            $errors[] = $helper->__('Review can\'t be empty');
        }

        if (empty($errors)) {
            return true;
        }
        return $errors;
    }
}
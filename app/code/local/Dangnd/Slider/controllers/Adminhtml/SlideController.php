<?php
/**
 * Created by PhpStorm.
 * User: nddang196
 * Date: 26-10-2017
 * Time: 09:26 SA
 */

class Dangnd_Slider_Adminhtml_SlideController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->_title($this->__('Manager Slider'))
            ->_title($this->__('Manage Slide'));

        $this->loadLayout()
            ->_setActiveMenu('slider')
            ->_addBreadcrumb(Mage::helper('dangnd_slider')->__('Manager Slider'),
                Mage::helper('dangnd_slider')->__('Manager Slider'))
            ->_addBreadcrumb(Mage::helper('dangnd_slider')->__('Manage Slide'),
                Mage::helper('dangnd_slider')->__('Manage Slide'));

        $this->_addContent($this->getLayout()
            ->createBlock('dangnd_slider/adminhtml_slide'))
            ->renderLayout();

        return $this;
    }

    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('admin');
    }

    public function newAction()
    {
        $this->_forward('edit');
    }

    public function editAction()
    {
        $this->_title($this->__('Manager Slider'))
            ->_title($this->__('Manage Slide'));

        $id = $this->getRequest()->getParam('id');
        $model = Mage::getModel('dangnd_slider/slide');
        $img = Mage::getModel('dangnd_slider/images');

        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                Mage::getSingleton('adminhtml/session')
                    ->addError(Mage::helper('dangnd_slider')->__('Id don\'t exists!'));

                $this->_redirect('*/*/');

                return;
            }
        }

        $title = $model->getId() ? sprintf('Edit Information Image %s', $model->getName()) : $this->__('Create New');
        $this->_title($title);

        Mage::register('slideModel', $model);
        Mage::register('imgModel', $img);
        $label = $id ? Mage::helper('dangnd_slider')->__('Edit') : Mage::helper('dangnd_slider')->__('Create');

        $this->loadLayout()
            ->_setActiveMenu('dangnd_slider/slide')
            ->_addBreadcrumb(Mage::helper('dangnd_slider')->__('Manager Slider'),
                Mage::helper('dangnd_slider')->__('Manager Slider'))
            ->_addBreadcrumb(Mage::helper('dangnd_slider')->__('Menage Menu'),
                Mage::helper('dangnd_slider')->__('Menage Slide'))
            ->_addBreadcrumb($label, $label);
        $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
        $this->_addContent($this->getLayout()
            ->createBlock('dangnd_slider/adminhtml_slide_edit'))
            ->_addLeft($this->getLayout()
                ->createBlock('dangnd_slider/adminhtml_slide_edit_tabs'));
        $this->renderLayout();
    }

    public function saveAction()
    {
        $data = $this->getRequest()->getParams();
        $imgs = $_FILES['image'];
        $imgEdit = $_FILES['imgEdit'];
//        die(var_dump($data));
//        if(!$data) {
//            return $this->getResponse()->setRedirect($this->getUrl('*/slide'));
//        }
        
        if($err = $this->validate($data) === true) {
            $new = Mage::getModel('dangnd_slider/slide');

            $new->setData($data);

            $slideId = isset($data['id']) ? $data['id'] : (max($new->getCollection()->getAllIds()) + 1);

            if(!empty($data['visibleImg'])) {
                $this->visibleImage($data['visibleImg']);
            }

            if(!empty($data['delImg'])) {
                $this->deleteImage($data['delImg']);
            }
            $this->editSildeImage($imgEdit, $slideId);

            if ($this->uploadImage($imgs, $slideId)) {
                try {
                    $new->save();

                    Mage::getSingleton('adminhtml/session')
                        ->addSuccess(Mage::helper('dangnd_slider')->__('Success!'));
                    if ($data['back']) {
                        return $this->_redirect('*/*/edit', ['id' => $new->getId()]);
                    }

                    return $this->_redirect('*/*/');
                } catch (Mage_Core_Exception $e) {
                    Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                } catch (Exception $e) {
                    Mage::getSingleton('adminhtml/session')
                        ->addError(Mage::helper('dangnd_slider')->__('An error occurred while saving!'));
                }
            } else {
                foreach ($err as $item) {
                    Mage::getSingleton('adminhtml/session')
                        ->addError(Mage::helper('dangnd_slider')->__($item));
                }
            }
        }

        Mage::getSingleton('adminhtml/session')->setRuleData($data);

        $this->_redirectReferer();
    }

    public function deleteAction()
    {
        $id = $this->getRequest()->getParam('id');
        if (!$id) {
            Mage::getSingleton('adminhtml/session')
                ->addError(Mage::helper('dangnd_slider')->__('Id don\'t exists!'));

            return $this->_redirect('*/*/');
        }

        try {
            $slide = Mage::getModel('dangnd_slider/slide');
            $slide->setId($id);
            $slide->delete();
            Mage::getSingleton('adminhtml/session')
                ->addSuccess(Mage::helper('dangnd_slider')->__('Delete Success.'));
        } catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')
                ->addError(Mage::helper('dangnd_slider')->__('An error occurred while deleting!'));
        }

        $this->_redirect('*/*/');
    }

    /*
     * @param $images : list file upload == $_FILE['field_name']
     * @return String or Array
     */
    public function checkImageUpload($images)
    {
        $maxSize = 5242880;
        $extImg = ['jpg', 'jpeg', 'png'];
        $result = [];

        foreach ($images['name'] as $key => $item) {
            if(is_array($item)) {
                $result[$key]['name'] = $images['name'][$key][0];
                $result[$key]['tmp_name'] = $images['tmp_name'][$key][0];
                $result[$key]['type'] = $images['type'][$key][0];
                $result[$key]['error'] = $images['error'][$key][0];
                $result[$key]['size'] = $images['size'][$key][0];
            } else {
                $result[$key]['name'] = $images['name'][$key];
                $result[$key]['tmp_name'] = $images['tmp_name'][$key];
                $result[$key]['type'] = $images['type'][$key];
                $result[$key]['error'] = $images['error'][$key];
                $result[$key]['size'] = $images['size'][$key];
            }

            if($result[$key]['size'] === 0) {
                continue;
            }
            if ($result[$key]['size'] > $maxSize) {
                return "File {$result[$key]['name']} size too large ( Maximum : 5M )";
            }
            $ext = end(explode('.', $result[$key]['name']));
            if (!in_array($ext, $extImg)) {
                return "Only accepted photo format: jpg, jpeg, png";
            }
        }

        return $result;
    }

//    public function visibleImage($images)
//    {
//        $imgModel = Mage::getModel('dangnd_slider/images');
//
//        foreach ($images as $image) {
//            $imgModel->setId($image);
//            $imgModel->setVisible(1);
//            $imgModel->save();
//        }
//    }

    public function uploadImage($images, $slideId)
    {
        $imgModel = Mage::getModel('dangnd_slider/images');

        if($images['size'][0] === 0) {
            return true;
        }

        $dir = 'dangnd/slide';
        $path = Mage::getBaseDir('media') . DS . $dir;
        $images = $this->checkImageUpload($images);

        if (!file_exists($path)) {
            mkdir($path, 0777);
        }
        if (is_array($images)) {
            try {
                $id = max($imgModel->getCollection()->getAllIds());
                foreach ($images as $key => $item) {
                    $upload = new Varien_File_Uploader($item);
                    $id++;
                    $data['name'] = "slide_{$slideId}_{$id}.{$upload->getFileExtension()}";
                    $data['slideId'] = $slideId;
                    $upload->save($path, $data['name']);

                    $imgModel->setData($data);
                    $imgModel->save();
                }
            } catch (Exception $e) {
                return false;
            }

            return true;
        }
        Mage::getSingleton('adminhtml/session')
            ->addError(Mage::helper('dangnd_slider')
                ->__($images));

        return false;
    }

    public function validate($data)
    {
        $err = [];
        $helper = Mage::helper('dangnd_slider');

        if(!Zend_Validate::is($data['name'], 'NotEmpty')) {
            $err[] = $helper->__('Slide name can\'t be empty');
        }

        if(empty($err)) {
            return true;
        }

        return $err;
    }

    public function deleteImage($listId)
    {
        $imgModel = Mage::getModel('dangnd_slider/images');

        foreach ($listId as $item) {
            $imgModel->setId($item)->delete();
        }
    }

    public function editSildeImage($images, $slideId)
    {
        $dir = 'dangnd/slide';
        $path = Mage::getBaseDir('media') . DS . $dir;
        $images = $this->checkImageUpload($images);

        if (!file_exists($path)) {
            mkdir($path, 0777);
        }
        if (is_array($images)) {
            try {
                foreach ($images as $key => $item) {
                    if($item['size'] === 0) {
                        continue;
                    }
                    $upload = new Varien_File_Uploader($item);
                    $newName = "slide_{$slideId}_{$key}.{$upload->getFileExtension()}";
                    $upload->save($path, $newName);
                }
            } catch (Exception $e) {
                return false;
            }

            return true;
        }
        Mage::getSingleton('adminhtml/session')
            ->addError(Mage::helper('dangnd_slider')
                ->__($images));

        return false;
    }

    public function multiDeleteAction()
    {
        $listId = $this->getRequest()->getParam('slideId');
        $model  = Mage::getModel('dangnd_slider/slide');

        if(empty($listId)) {
            Mage::getSingleton('adminhtml/session')
                ->addError(Mage::helper('dangnd_slider')->__('Please select a line to delete!'));
        } else {
            foreach ($listId as $item) {
                $model->setId($item)->delete();
            }

            Mage::getSingleton('adminhtml/session')
                ->addSuccess(Mage::helper('dangnd_slider')->__('Delete Success.'));
        }

        $this->_redirect('*/*/');
    }
}
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
        $newImg = $_FILES['image'];
        $imgEdit = $_FILES['imgEdit'];
        $err = $this->validate($data, $newImg, $imgEdit);
        if ($err === true) {
            $slide = Mage::getModel('dangnd_slider/slide');
            $image = Mage::getModel('dangnd_slider/images');

            $slide->setData($data);
            try {
                $key = time();
                $slide->save();

                if (!empty($data['delImg'])) {
                    $this->deleteImage($data['delImg']);
                }
                if ($newImg) {
                    foreach ($newImg as $item) {
                        $imgName = $this->uploadImage($item, $slide->getId(), ++$key);
                        $image->setData(array(
                            'slideId' => $slide->getId(),
                            'visible' => 1,
                            'name'    => $imgName
                        ));
                        $image->save();
                    }
                }
                if ($imgEdit) {
                    foreach ($imgEdit as $index => $item) {
                        $imgName = $this->uploadImage($item, $slide->getId(), ++$key);
                        $image->setData(array(
                            'id'      => $index,
                            'name'    => $imgName
                        ));
                        $image->save();
                    }
                }

                Mage::getSingleton('adminhtml/session')
                    ->addSuccess(Mage::helper('dangnd_slider')->__('Success!'));
                if ($data['back']) {
                    return $this->_redirect('*/*/edit', ['id' => $slide->getId()]);
                }

                return $this->_redirect('*/*/');
            } catch (Mage_Core_Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')
                    ->addError(Mage::helper('dangnd_slider')->__('An error occurred while saving!'));
            }
        } else {
            Mage::getSingleton('adminhtml/session')
                ->addError(Mage::helper('dangnd_slider')->__($err));
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

    public function validate($data, &$newImg, &$editImg)
    {
        $err = '';

        if (empty($data['name'])) {
            $err .= 'Name is a required field';
        } else {
            if (strlen($data['name']) > strlen(strip_tags($data['name']))) {
                $err .= '<br>Name : HTML tags are not allowed';
            }
        }
        $newImg = $this->checkImageUpload($newImg);
        if (is_string($newImg)) {
            $err .= '<br>' . $newImg;
        }
        $editImg = $this->checkImageUpload($editImg);
        if (is_string($editImg)) {
            $err .= '<br>' . $editImg;
        }

        if (empty($err)) {
            foreach ($newImg as $key => $item) {
                if(empty($item['name'])) {
                    unset($newImg[$key]);
                }
            }
            foreach ($editImg as $key => $item) {
                if(empty($item['name'])) {
                    unset($editImg[$key]);
                }
            }

            return true;
        }

        return ltrim($err, '<br>');
    }

    public function deleteImage($listId)
    {
        $imgModel = Mage::getModel('dangnd_slider/images');

        foreach ($listId as $item) {
            $imgModel->setId($item)->delete();
        }
    }

    public function multiDeleteAction()
    {
        $listId = $this->getRequest()->getParam('slideId');
        $model = Mage::getModel('dangnd_slider/slide');

        if (empty($listId)) {
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

    /**
     * @param       $images
     * @param int   $max_size
     * @param array $allowExt
     *
     * @return array|string
     */
    public function checkImageUpload($images, $max_size = 5242880, $allowExt = ['jpg', 'jpeg', 'png'])
    {
        $result = [];

        foreach ($images['name'] as $key => $item) {
            if (is_array($item)) {
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

            if ($result[$key]['size'] === 0) {
                continue;
            }
            if ($result[$key]['size'] > $max_size) {
                return "File {$result[$key]['name']} size too large ( Maximum : 5M )";
            }
            $ext = end(explode('.', $result[$key]['name']));
            if (!in_array($ext, $allowExt)) {
                return "Only accepted photo format: jpg, jpeg, png";
            }
        }

        return $result;
    }

    /**
     * @param     $image
     * @param int $slideId
     * @param int $key
     *
     * @return bool | string
     */
    public function uploadImage($image, $slideId, $key)
    {
        $dir = 'dangnd/slide';
        $path = Mage::getBaseDir('media') . DS . $dir;

        if (!file_exists($path)) {
            mkdir($path, 0777);
        }

        try {
            $upload = new Varien_File_Uploader($image);
            $newName = "slide_{$slideId}_{$key}." . $upload->getFileExtension();
            $upload->save($path, $newName);

            return $newName;
        } catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());

            return false;
        }
    }
}
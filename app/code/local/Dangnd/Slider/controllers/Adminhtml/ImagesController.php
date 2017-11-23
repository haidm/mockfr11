<?php
/**
 * Created by PhpStorm.
 * User: nddang196
 * Date: 26-10-2017
 * Time: 09:27 SA
 */

class Dangnd_Slider_Adminhtml_ImagesController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->_title($this->__('Manager Slider'))
            ->_title($this->__('Manage Images'));

        $this->loadLayout()
            ->_setActiveMenu('slider')
            ->_addBreadcrumb(Mage::helper('dangnd_slider')->__('Manager Slider'),
                Mage::helper('dangnd_slider')->__('Manager Slider'))
            ->_addBreadcrumb(Mage::helper('dangnd_slider')->__('Manage Images'),
                Mage::helper('dangnd_slider')->__('Manage Images'));

        $this->_addContent($this->getLayout()
            ->createBlock('dangnd_slider/adminhtml_images'))
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
            ->_title($this->__('Manage Images'));

        $id = $this->getRequest()->getParam('id');
        $model = Mage::getModel('dangnd_slider/images');

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

        Mage::register('imgModel', $model);

        $this->loadLayout()
            ->_setActiveMenu('dangnd_slider/images')
            ->_addBreadcrumb(Mage::helper('dangnd_slider')->__('Manager Slider'),
                Mage::helper('dangnd_slider')->__('Manager Slider'))
            ->_addBreadcrumb(Mage::helper('dangnd_slider')->__('Menage Menu'),
                Mage::helper('dangnd_slider')->__('Menage Images'));

        $label = $id ? Mage::helper('dangnd_slider')->__('Edit') : Mage::helper('dangnd_slider')->__('Create');
        $this->_addBreadcrumb($label, $label)
            ->_addContent($this->getLayout()
                    ->createBlock('dangnd_slider/adminhtml_images_edit')
                    ->setData('action', $this->getUrl('*/images/save'))
            )->renderLayout();
    }

    public function saveAction()
    {
        $data = $this->getRequest()->getParams();
        if (!$data) {
            return $this->getResponse()->setRedirect($this->getUrl('*/images'));
        }
        $new = isset($data['id']) ? true : false;
        $validate = $this->validate($data, $new);
        if($validate === true) {
            $item = Mage::getModel('dangnd_slider/images');
            $id = isset($data['id']) ? $data['id'] : (max($item->getCollection()->getAllIds()) + 1);

            if (empty($data['visible'])) {
                $data['visible'] = 0;
            }

            if (!empty($_FILES['image']['name'])) {
                try {
                    $dir = 'dangnd/slide';
                    $path = Mage::getBaseDir('media') . DS . $dir;
                    if (!file_exists($path)) {
                        mkdir($path, 0777);
                    } else {
                        if (isset($data['id'])) {
                            $item->load($data['id']);
                            if(empty($data['keep'])) {
                                unlink($path . '/' . $item->getName());
                            } else {
                                rename($path . '/' . $item->getName(), $path . '/old_' . $item->getName());
                            }
                        }
                    }
                    $uploader = new Varien_File_Uploader('image');
                    $uploader->setAllowedExtensions(array('jpg', 'jpeg', 'gif', 'png'));

                    $newName = 'slide_' . $data['slideId'] . '_' . $id . '.' . $uploader->getFileExtension();
                    $uploader->save($path, $newName);
                    $data['name'] = $newName;
                } catch (Exception $e) {

                }
            }

            $item->setData($data);
            try {
                $item->save();

                Mage::getSingleton('adminhtml/session')
                    ->addSuccess(Mage::helper('dangnd_slider')->__('Success!'));

                if ($data['back']) {
                    return $this->_redirect('*/*/edit', array('id' => $item->getId()));
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
                ->addError(Mage::helper('dangnd_slider')->__($validate));
        }

        Mage::getSingleton('adminhtml/session')->setRuleData($data);

        $this->_redirectReferer();
    }

    public function deleteAction()
    {
        $id = $this->getRequest()->getParam('id');
        $path = Mage::getBaseDir('media') . DS . 'dangnd/slide';
        if (!$id) {
            Mage::getSingleton('adminhtml/session')
                ->addError(Mage::helper('dangnd_slider')->__('Id don\'t exists!'));
            return $this->_redirect('*/*/');
        }

        try {
            $image = Mage::getModel('dangnd_slider/images');
            $image->load($id);
            unlink($path . '/' . $image->getName());
            $image->delete();
            Mage::getSingleton('adminhtml/session')
                ->addSuccess(Mage::helper('dangnd_slider')->__('Delete Success.'));
        } catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')
                ->addError(Mage::helper('dangnd_slider')->__('An error occurred while deleting!'));
        }

        $this->_redirect('*/*/');
    }

    public function multiDeleteAction()
    {
        $listId = $this->getRequest()->getParam('imageId');
        $model = Mage::getModel('dangnd_slider/images');
        $path = Mage::getBaseDir('media') . DS . 'dangnd/slide';

        if (empty($listId)) {
            Mage::getSingleton('adminhtml/session')
                ->addError(Mage::helper('dangnd_slider')->__('Please select a line to delete!'));
        } else {
            foreach ($listId as $item) {
                $model->load($item);
                unlink($path . '/' . $model->getName());
                $model->delete();
            }

            Mage::getSingleton('adminhtml/session')
                ->addSuccess(Mage::helper('dangnd_slider')->__('Delete Success.'));
        }

        $this->_redirect('*/*/');
    }

    /**
     * @param array $data
     * @param bool  $new
     *
     * @return bool|string
     */
    public function validate($data = array(), $new)
    {
        $err = '';
        if(!empty($data['content'])) {
            if(strlen($data['content']) > strlen(strip_tags($data['content']))) {
                $err .= '<br>Content : HTML tags are not allowed';
            }
        }
        if(!empty($data['link'])) {
            if(strlen($data['link']) > strlen(strip_tags($data['link']))) {
                $err .= '<br>Link : HTML tags are not allowed';
            }
        }
        if (!empty($_FILES['image']['name'])) {
            $ext = end(explode('.', $_FILES['image']['name']));
            if ($_FILES['image']['size'] > 5242880) {
                $err .= '<br>Image size must be less than 5M';
            }
            if (!in_array($ext, ['jpg', 'jpeg', 'png'])) {
                $err .= "<br>Only accepted photo format: jpg, jpeg, png";
            }
        } else {
            if($new != 0) {
                $err .= '<br>Image is a required field';
            }
        }

        if($err) {
            return ltrim($err, '<br>');
        }

        return true;
    }
}
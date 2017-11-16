<?php
/**
 * Created by PhpStorm.
 * User: hungbui
 * Date: 29/10/2017
 * Time: 14:39
 */

/**
 * Slider Controller
 * @category    Hungbd
 * @package     Hungbd_Slider_Adminhtml
 * @author      hungbd <hungbd@smartosc.com>
 */
class Hungbd_Slider_Adminhtml_SliderController extends Mage_Adminhtml_Controller_Action
{
    /**
     * Index action
     * Render slider grid
     */
    public function indexAction()
    {
        $this->_title($this->__('Slider'));
        $this->loadLayout()
            ->_setActiveMenu('hungbd/slider')
            ->_addBreadcrumb(Mage::helper('core')->__('Slider'), Mage::helper('core')->__('Slider'))
            ->_addBreadcrumb(Mage::helper('core')->__('Slider'), Mage::helper('core')->__('Slider'));
        $this->_addContent($this->getLayout()->createBlock('hungbd_slider/adminhtml_silder'))
            ->renderLayout();
    }

    /**
     * Edit action
     * Render Edit Form
     */
    public function editAction()
    {

        $this->_title($this->__('Slider'));
        $sliderId = $this->getRequest()->getParam('id');
        $sliderImageModel = Mage::getModel('hungbd_slider/image')->getCollection();
        $sliderModel = Mage::getModel('hungbd_slider/slider');
        if ($sliderId) {
            $sliderModel->load($sliderId);
            // join 2 table to get list of image in slider
            $listImage = Mage::getModel('hungbd_slider/listimage')
                ->getCollection()
                ->join(array('image' => 'hungbd_slider/image'),
                    'main_table.image_id=image.id',
                    array('name'))
                ->addFilter('slider_id', $sliderId);
            Mage::register('list_image', $listImage);
            if (!$sliderModel->getId()) {
                Mage::getSingleton('adminhtml/session')
                    ->addError(Mage::helper('core')->__('Slider ko ton tai!'));
                $this->_redirect('*/*/');
                return;
            }
        }
        $this->_title($sliderModel->getId() ? sprintf("Edit Slider  %s", $sliderModel->getName()) : $this->__('New Slider '));

        Mage::register('slider_image', $sliderImageModel);
        Mage::register('slider', $sliderModel);


        $this->loadLayout();
        $this->_setActiveMenu('hungbd/slider');
        $this->_addBreadcrumb('Slider', 'Slider');
        $this->_addBreadcrumb('Image', 'Image');
        $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
        $this->_addContent($this->getLayout()
            ->createBlock('hungbd_slider/adminhtml_slider_edit'));
        $this->renderLayout();
    }

    /**
     * Save action
     * Save slider to db
     */
    public function saveAction()
    {
        $postData = $this->getRequest()->getParams();
        if ($this->validate($postData) == 'true') {
            if (!$postData) {
                return $this->getResponse()->setRedirect($this->getUrl('*/image'));
            }
            $sliderId = $this->getRequest()->getParam('id');
            $sliderName = $this->getRequest()->getParam('name');
            $oldListImage = $this->getRequest()->getParam('listimage');
            $newListImage = $this->getRequest()->getParam('newimage');
            $slider = Mage::getModel('hungbd_slider/slider');
            $slider->setId($sliderId)->setName($sliderName);
            try {
                $slider->save();
                if ($sliderId) {
                    if ($oldListImage) {
                        $listSliderInList = Mage::getModel('hungbd_slider/listimage')
                            ->getCollection()
                            ->addFilter('slider_id', $sliderId);
                        foreach ($listSliderInList as $item) {
                            if (!in_array($item->id, $oldListImage)) {
                                $id[] = $item->id;
                            }
                        }
                        $deleteListImage = Mage::getModel('hungbd_slider/listimage')
                            ->getCollection()
                            ->addFieldToFilter('id', $id);
                        foreach ($deleteListImage as $item) {
                            $item->delete();
                        }
                    }
                    if ($newListImage) {
                        foreach ($newListImage as $item) {
                            Mage::getModel('hungbd_slider/listimage')
                                ->setImage_id($item)
                                ->setSlider_id($sliderId)
                                ->save();
                        }
                    }

                } else {
                    if ($newListImage) {
                        foreach ($newListImage as $item) {
                            Mage::getModel('hungbd_slider/listimage')
                                ->setImage_id($item)
                                ->setSlider_id($slider->getId())
                                ->save();
                        }
                    }
                }
                Mage::getSingleton('adminhtml/session')
                    ->addSuccess(Mage::helper('core')->__('The Slider has been saved.'));

                if ($this->getRequest()->getParam('back')) {
                    return $this->_redirect('*/*/edit', array('id' => $slider->getId()));
                }
                return $this->_redirect('*/*/');

            } catch (Mage_Core_Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            } catch
            (Exception $e) {
                Mage::getSingleton('adminhtml/session')
                    ->addError(Mage::helper('core')->__('An error occurred while saving this item.'));
            }
            Mage::getSingleton('adminhtml/session')->setRuleData($postData);
            $this->_redirectReferer();
        } else {
            Mage::getSingleton('adminhtml/session')->setRuleData($postData);
            foreach ($this->validate($postData) as $error) {
                Mage::getSingleton('adminhtml/session')
                    ->addError(Mage::helper('core')->__($error));
            }
            $this->_redirectReferer();
        }
    }

    /**
     * Delete action
     */
    public function deleteAction()
    {
        $sliderId = $this->getRequest()->getParam('id');
        if (!$sliderId) {
            Mage::getSingleton('adminhtml/session')
                ->addError(Mage::helper('core')->__('Slider ko ton tai!'));
            return $this->_redirect('*/*/');
        }

        try {
            $slider = Mage::getModel('hungbd_slider/slider');
            $slider->setId($sliderId);
            $slider->delete();
            Mage::getSingleton('adminhtml/session')
                ->addSuccess(Mage::helper('core')->__('The Slider has been deleted.'));
        } catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')
                ->addError(Mage::helper('core')->__('An error occurred while deleting this Image.'));
        }
        $this->_redirect('*/*/');
    }

    /**
     * Redirect to edit action
     */
    public function newAction()
    {
        $this->_forward('edit');
    }

    /**
     * Validate function
     * @param array $data
     * @return true or array error
     */
    private function validate($data)
    {
        $errors = array();

        if (!Zend_Validate::is($data['name'], 'Regex', array('/^[a-z A-Z 0-9]{1,15}$/'))) {
            $errors[] = Mage::helper('core')->__('Not a valid Name');
        }

        if ($data['id']) {
            if (!Zend_Validate::is($data['id'], 'Regex', array('/^[0-9]+$/'))) {
                $errors[] = Mage::helper('core')->__('Not a valid id');
            }
        }

        if ($data['listimage']) {
            foreach ($data['listimage'] as $item) {
                if (!Zend_Validate::is($item, 'Regex', array('/^[0-9]+$/'))) {
                    $errors[] = Mage::helper('core')->__('Not a valid image');
                }
            }
        }

        if ($data['newimage']) {
            foreach ($data['newimage'] as $item) {
                if (!Zend_Validate::is($item, 'Regex', array('/^[0-9]+$/'))) {
                    $errors[] = Mage::helper('core')->__('Not a valid image');
                }
            }
        }

        if ($errors) {
            return $errors;
        } else {
            return 'true';
        }
    }
}
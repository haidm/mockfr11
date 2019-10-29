<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 10/30/2017
 * Time: 11:19 AM
 */
class AnhNT9_Slider_Adminhtml_SliderController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->_title($this->__('Slider'))
            ->_title($this->__('Slider Manager'));

        $this->loadLayout()
            ->_setActiveMenu('slider/slider')
            ->_addBreadcrumb(Mage::helper('anhnt9_slider')->__('Slider'), Mage::helper('anhnt9_slider')->__('Slider'))
            ->_addBreadcrumb(Mage::helper('anhnt9_slider')->__('Slider Manager'), Mage::helper('anhnt9_slider')->__('Slider Manager'))
        ;

        $this->_addContent($this->getLayout()->createBlock('anhnt9_slider/adminhtml_slider'))
            ->renderLayout();
        return $this;
    }

    /**
     * Edit action
     */
    public function editAction()
    {
        $this->_title($this->__('Slider'))
            ->_title($this->__('Slider Manager'));

        $sliderId  = $this->getRequest()->getParam('slider_id');
        $sliderModel  = Mage::getModel('anhnt9_slider/slider');
        if ($sliderId) {
            $sliderModel->load($sliderId);
            if (!$sliderModel->getId()) {
                Mage::getSingleton('adminhtml/session')
                    ->addError(Mage::helper('anhnt9_slider')->__('Slider ko ton tai!'));
                $this->_redirect('*/*/');
                return;
            }
        }


        $this->_title($sliderModel->getId() ? sprintf("Edit order %s", $sliderModel->getName()) : $this->__('New Order'));

        Mage::register('slidermodel', $sliderModel);

        $this->loadLayout()
            ->_setActiveMenu('slider/slider')
            ->_addBreadcrumb(Mage::helper('anhnt9_slider')->__('Slider'), Mage::helper('anhnt9_slider')->__('Slider'))
            ->_addBreadcrumb(Mage::helper('anhnt9_slider')->__('Slider Manager'), Mage::helper('anhnt9_slider')->__('Slider Manager'));

        $this->_addBreadcrumb(
            $sliderId ? Mage::helper('anhnt9_slider')->__('Edit slider') :  Mage::helper('anhnt9_slider')->__('New Slider'),
            $sliderId ?  Mage::helper('anhnt9_slider')->__('Edit slider') :  Mage::helper('anhnt9_slider')->__('New Slider'))
            ->_addContent($this->getLayout()->createBlock('anhnt9_slider/adminhtml_slider_edit')
            ->setData('action', $this->getUrl('*/slider/save')))
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
            return $this->getResponse()->setRedirect($this->getUrl('*/slider'));
        }

        $slider = Mage::getModel('anhnt9_slider/slider');
        $slider->setData($postData);

        try {
            $slider->save();

            Mage::getSingleton('adminhtml/session')
                ->addSuccess(Mage::helper('anhnt9_slider')->__('The slider has been saved.'));

            if ($this->getRequest()->getParam('back')) {
                return $this->_redirect('*/*/edit', array('slider_id' => $slider->getId()));
            }

            return $this->_redirect('*/*/');
        }
        catch (Mage_Core_Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        }
        catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')
                ->addError(Mage::helper('anhnt9_slider')->__('An error occurred while saving this slider.'));
        }

        Mage::getSingleton('adminhtml/session')->setRuleData($postData);
        $this->_redirectReferer();
    }
    /**
     * Delete slider
     */
    public function deleteAction()
    {
        $sliderId = $this->getRequest()->getParam('slider_id');
        if (!$sliderId) {
            Mage::getSingleton('adminhtml/session')
                ->addError(Mage::helper('anhnt9_slider')->__('Slider ko ton tai!'));
            return $this->_redirect('*/*/');
        }

        try {
            $order = Mage::getModel('anhnt9_slider/slider');
            $order->setId($sliderId);
            $order->delete();
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
}
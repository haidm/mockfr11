<?php
class Hienth_Slider_Adminhtml_SliderController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->_title($this->__('Slider'))
            ->_title($this->__('SLider'));
        $this->loadLayout()
            ->_setActiveMenu('mega')
            ->_addBreadcrumb(Mage::helper('Hienth_Slider')->__('Slider'), Mage::helper('Hienth_Slider')->__('Slider'))
            ->_addBreadcrumb(Mage::helper('Hienth_Slider')->__('Slider'), Mage::helper('Hienth_Slider')->__('Slider'))
        ;
        $this->_addContent($this->getLayout()->createBlock('Hienth_Slider/adminhtml_slider'))
            ->renderLayout();
        return $this;
    }
    public function newAction()
    {
        $this->_forward('edit');
    }
    public function editAction()
    {
        $this->_title($this->__('Slider'))
            ->_title($this->__('Edit Slider'));
        $sliderId  = $this->getRequest()->getParam('id');
        $sliderModel  = Mage::getModel('Hienth_Slider/slider');
        $modelSlider = Mage::getModel('Hienth_Slider/slider')->load($sliderId);
        Mage::register('modelSlider',$modelSlider);
        Mage::register('sliderId', $sliderId);
        if ($sliderId) {
            $sliderModel->load($sliderId);
            if (!$sliderModel->getId()) {
                Mage::getSingleton('adminhtml/session')
                    ->addError(Mage::helper('core')->__('Image không tồn tại!'));
                $this->_redirect('*/*/');
                return;
            }
        }
        $this->_title($sliderModel->getId() ? sprintf("Edit Slider %s", $sliderModel->getName()) : $this->__('New Image'));
        $this->loadLayout()
            ->_setActiveMenu('mega')
            ->_addBreadcrumb(Mage::helper('core')->__('Slider'), Mage::helper('core')->__('Slider'))
            ->_addBreadcrumb(Mage::helper('core')->__('Slider Item'), Mage::helper('core')->__('Slider Item'))
        ;
        $this->_addBreadcrumb(
            $sliderId ? Mage::helper('core')->__('Edit Slider') :  Mage::helper('core')->__('New Slider'),
            $sliderId ?  Mage::helper('core')->__('Edit Slider') :  Mage::helper('core')->__('New Slider'))
            ->_addContent($this->getLayout()->createBlock('Hienth_Slider/adminhtml_slider_edit')
                ->setData('action', $this->getUrl('*/slider/save')))
            ->renderLayout();
    }
    public function saveAction()
    {
        $postdata = $this->getRequest()->getParams();
        $list = implode('-', $postdata['list_image']);
        $model = Mage::getModel('Hienth_Slider/slider');
        $model->setName($postdata['name'])
              ->setList_image($list);
        if($postdata['sliderId'])
        {
            $model->setId($postdata['sliderId']);
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
    public function deleteAction()
    {
        $sliderId = $this->getRequest()->getParam('id');
        try {
            Mage::getModel('Hienth_Slider/slider')
                ->setId($sliderId)
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
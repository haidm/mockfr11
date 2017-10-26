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
            ->_setActiveMenu('dangnd_slider/slide')
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

        if ($id)
        {
            $model->load($id);
            if (!$model->getId())
            {
                Mage::getSingleton('adminhtml/session')
                    ->addError(Mage::helper('dangnd_slider')->__('Id don\'t exists!'));

                $this->_redirect('*/*/');

                return;
            }
        }

        $title = $model->getId() ? sprintf('Edit Information Image %s', $model->getName()) : $this->__('Create New');
        $this->_title($title);

        Mage::register('slideModel', $model);

        $this->loadLayout()
            ->_setActiveMenu('dangnd_slider/slide')
            ->_addBreadcrumb(Mage::helper('dangnd_slider')->__('Manager Slider'),
                Mage::helper('dangnd_slider')->__('Manager Slider'))
            ->_addBreadcrumb(Mage::helper('dangnd_slider')->__('Menage Menu'),
                Mage::helper('dangnd_slider')->__('Menage Slide'));

        $label = $id ? Mage::helper('dangnd_slider')->__('Edit') : Mage::helper('dangnd_slider')->__('Create');
        $this->_addBreadcrumb($label, $label)
            ->_addContent(
                $this->getLayout()
                    ->createBlock('dangnd_slider/adminhtml_slide_edit')
                    ->setData('action', $this->getUrl('*/slide/save'))
            )->renderLayout();
    }

    public function saveAction()
    {
        $data = $this->getRequest()->getParams();

        if (!$data)
        {
            return $this->getResponse()->setRedirect($this->getUrl('*/slide'));
        }

        $menu = Mage::getModel('dangnd_slider/slide');

        $menu->setData($data);

        try
        {
            $menu->save();

            Mage::getSingleton('adminhtml/session')
                ->addSuccess(Mage::helper('dangnd_slider')->__('Success!'));

            if ($data['back'])
            {
                return $this->_redirect('*/*/edit', array('id' => $menu->getId()));
            }

            return $this->_redirect('*/*/');
        } catch (Mage_Core_Exception $e)
        {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        } catch (Exception $e)
        {
            Mage::getSingleton('adminhtml/session')
                ->addError(Mage::helper('dangnd_slider')->__('An error occurred while saving!'));
        }

        Mage::getSingleton('adminhtml/session')->setRuleData($data);

        $this->_redirectReferer();
    }

    public function deleteAction()
    {
        $id = $this->getRequest()->getParam('id');
        if (!$id)
        {
            Mage::getSingleton('adminhtml/session')
                ->addError(Mage::helper('dangnd_slider')->__('Id don\'t exists!'));
            return $this->_redirect('*/*/');
        }

        try
        {
            $order = Mage::getModel('dangnd_slider/slide');
            $order->setId($id);
            $order->delete();
            Mage::getSingleton('adminhtml/session')
                ->addSuccess(Mage::helper('dangnd_slider')->__('Delete Success.'));
        } catch (Exception $e)
        {
            Mage::getSingleton('adminhtml/session')
                ->addError(Mage::helper('dangnd_slider')->__('An error occurred while deleting!'));
        }

        $this->_redirect('*/*/');
    }
}
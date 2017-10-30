<?php
/**
 * Created by PhpStorm.
 * User: nddang196
 * Date: 24-10-2017
 * Time: 02:06 CH
 */

class Datdt_MegaMenu_Adminhtml_CustomController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->_title($this->__('MegaMenu Manager'))
            ->_title($this->__('Manage Custom'));

        $this->loadLayout()
            ->_setActiveMenu('datdt_megamenu/custom')
            ->_addBreadcrumb(Mage::helper('datdt_megamenu')->__('MegaMenu Manager'), Mage::helper('datdt_megamenu')->__('MegaMenu Manager'))
            ->_addBreadcrumb(Mage::helper('datdt_megamenu')->__('Manage Custom'), Mage::helper('datdt_megamenu')->__('Manage Custom'));

        $this->_addContent($this->getLayout()
            ->createBlock('datdt_megamenu/adminhtml_custom'))
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
        $this->_title($this->__('MegaMenu Manager'))
            ->_title($this->__('Manage Custom'));

        $id = $this->getRequest()->getParam('id');
        $model = Mage::getModel('datdt_megamenu/custom');

        if ($id)
        {
            $model->load($id);
            if (!$model->getId())
            {
                Mage::getSingleton('adminhtml/session')
                    ->addError(Mage::helper('datdt_megamenu')->__('Id don\'t exists!'));

                $this->_redirect('*/*/');

                return;
            }
        }

        $title = $model->getId() ? sprintf('Edit order %s', $model->getName()) : $this->__('Create New');
        $this->_title($title);

        Mage::register('customModel', $model);

        $this->loadLayout()
            ->_setActiveMenu('datdt_megamenu/custom')
            ->_addBreadcrumb(Mage::helper('datdt_megamenu')->__('Manager MegaMenu'),
                Mage::helper('datdt_megamenu')->__('Manager MegaMenu'))
            ->_addBreadcrumb(Mage::helper('datdt_megamenu')->__('Manage Custom'),
                Mage::helper('datdt_megamenu')->__('Manage Custom'));

        $label = $id ? Mage::helper('datdt_megamenu')->__('Edit') : Mage::helper('datdt_megamenu')->__('Create');
        $this->_addBreadcrumb($label, $label)
            ->_addContent(
                $this->getLayout()
                    ->createBlock('datdt_megamenu/adminhtml_custom_edit')
                    ->setData('action', $this->getUrl('*/custom/save'))
            )->renderLayout();
    }

    public function saveAction()
    {
        $data = $this->getRequest()->getParams();

        if (!$data)
        {
            return $this->getResponse()->setRedirect($this->getUrl('*/custom'));
        }

        $item = Mage::getModel('datdt_megamenu/custom');

        $item->setData($data);

        try
        {
            $item->save();

            Mage::getSingleton('adminhtml/session')
                ->addSuccess(Mage::helper('datdt_megamenu')->__('Success!'));

            if ($data['back'])
            {
                return $this->_redirect('*/*/edit', array('id' => $item->getId()));
            }

            return $this->_redirect('*/*/');
        }
        catch (Mage_Core_Exception $e)
        {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        }
        catch (Exception $e)
        {
            Mage::getSingleton('adminhtml/session')
                ->addError(Mage::helper('datdt_megamenu')->__('An error occurred while saving!'));
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
                ->addError(Mage::helper('datdt_megamenu')->__('Id don\'t exists!'));
            return $this->_redirect('*/*/');
        }

        try
        {
            $order = Mage::getModel('datdt_megamenu/custom');
            $order->setId($id);
            $order->delete();
            Mage::getSingleton('adminhtml/session')
                ->addSuccess(Mage::helper('datdt_megamenu')->__('Delete Success.'));
        }
        catch (Exception $e)
        {
            Mage::getSingleton('adminhtml/session')
                ->addError(Mage::helper('datdt_megamenu')->__('An error occurred while deleting!'));
        }

        $this->_redirect('*/*/');
    }
}
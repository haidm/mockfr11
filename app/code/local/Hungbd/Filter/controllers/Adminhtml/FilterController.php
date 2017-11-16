<?php
/**
 * Created by PhpStorm.
 * User: hungbui
 * Date: 13/11/2017
 * Time: 15:34
 */

/**
 * Filter Controller
 * @category    Hungbd
 * @package     Hungbd_Filter_Adminhtml
 * @author      hungbd <hungbd@smartosc.com>
 */
class Hungbd_Filter_Adminhtml_FilterController extends Mage_Adminhtml_Controller_Action
{
    /**
     * Index action
     * Render grid
     */
    public function indexAction()
    {
        $this->_title($this->__('Filter'))->_title($this->__('Manage Filter'));
        $this->loadLayout()
            ->_setActiveMenu('hungbd')
            ->_addBreadcrumb(Mage::helper('core')->__('Filter'), Mage::helper('core')->__('Menu Item'))
            ->_addBreadcrumb(Mage::helper('core')->__('Filter'), Mage::helper('core')->__('Mega Menu'));
        $this->_addContent($this->getLayout()->createBlock('hungbd_filter/adminhtml_filter'))
            ->renderLayout();
    }

    /**
     * Edit action
     * Render Edit Form
     */
    public function editAction()
    {
        $this->_title($this->__('Manage Filter'));
        $filterId = $this->getRequest()->getParam('id');
        $filterModel = Mage::getResourceModel('catalog/product_attribute_collection')
            ->addFieldToFilter('additional_table.attribute_id', $filterId)
            ->getFirstItem();
        Mage::register('filter_model', $filterModel);
        $this->loadLayout();
        $this->_setActiveMenu('hungbd');
        $this->_addBreadcrumb('Fitler', 'Filter');
        $this->_addContent($this->getLayout()
            ->createBlock('hungbd_filter/adminhtml_filter_edit'));
        $this->renderLayout();


    }

    /**
     * Save action
     * Save filter type to database
     */
    public function saveAction()
    {
        $postData = $this->getRequest()->getParams();
        $attributeId = $this->getRequest()->getParam('id');
        $filterType = $this->getRequest()->getParam('filter_type');
        $attributeModel = Mage::getResourceModel('catalog/product_attribute_collection')
            ->addFieldToFilter('additional_table.attribute_id', $attributeId)
            ->getFirstItem();
        $attributeModel->setFilter_type($filterType);
        try {
            $attributeModel->save();

            Mage::getSingleton('adminhtml/session')
                ->addSuccess(Mage::helper('core')->__('The attribute has been saved.'));

            if ($this->getRequest()->getParam('back')) {
                return $this->_redirect('*/*/edit', array('id' => $attributeModel->attribute_id));
            }

            return $this->_redirect('*/*/');
        } catch (Mage_Core_Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        } catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')
                ->addError(Mage::helper('core')->__('An error occurred while saving this item.'));
        }
        Mage::getSingleton('adminhtml/session')->setRuleData($postData);
        $this->_redirectReferer();
    }
}

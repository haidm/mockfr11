<?php

/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 11/14/2017
 * Time: 9:40 AM
 */
class  AnhNT9_Filter_CatalogSearch_ResultController extends Mage_CatalogSearch_ResultController
{
    public function indexAction()
    {
        $params = $this->getRequest()->getParams();
        $response = array();
        $query = Mage::helper('catalogsearch')->getQuery();
        /* @var $query Mage_CatalogSearch_Model_Query */

        $query->setStoreId(Mage::app()->getStore()->getId());

        if ($query->getQueryText() != '') {
            if (Mage::helper('catalogsearch')->isMinQueryLength()) {
                $query->setId(0)
                    ->setIsActive(1)
                    ->setIsProcessed(1);
            } else {
                if ($query->getId()) {
                    $query->setPopularity($query->getPopularity() + 1);
                } else {
                    $query->setPopularity(1);
                }

                if ($query->getRedirect()) {
                    $query->save();
                    $this->getResponse()->setRedirect($query->getRedirect());
                    return;
                } else {
                    $query->prepare();
                }
            }

            Mage::helper('catalogsearch')->checkNotes();

            $this->loadLayout();
            if ($params['isAjax'] == 1) {  //Check if it was an AJAX request
                $viewpanel = $this->getLayout()->getBlock('catalogsearch.leftnav')->toHtml(); //Get the new Layered Manu
                $productlist = $this->getLayout()->getBlock('search_result_list')->toHtml(); //New product List
                $response['status'] = 'SUCCESS'; //Send Success
                $response['viewpanel'] = $viewpanel;
                $response['productlist'] = $productlist;
                $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($response));
                return;
            }
            $this->_initLayoutMessages('catalog/session');
            $this->_initLayoutMessages('checkout/session');
            $this->renderLayout();

            if (!Mage::helper('catalogsearch')->isMinQueryLength()) {
                $query->save();
            }
        } else {
            $this->_redirectReferer();
        }
    }
}
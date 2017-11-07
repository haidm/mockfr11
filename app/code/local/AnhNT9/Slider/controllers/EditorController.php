<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 11/2/2017
 * Time: 10:41 AM
 */
class AnhNT9_Slider_EditorController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }
}
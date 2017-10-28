<?php
/**
 * Created by PhpStorm.
 * User: TuanAnh
 * Date: 10/25/2017
 * Time: 3:03 PM
 */
class AnhNT9_ProductZoom_IndexController extends Mage_Core_Controller_Front_Action{
    public function indexAction(){
        $this->loadLayout('anhnt9_productzoom');
        $this->renderLayout();
    }
}
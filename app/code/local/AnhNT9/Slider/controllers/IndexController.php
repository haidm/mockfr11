<?php
/**
 * Created by PhpStorm.
 * User: TuanAnh
 * Date: 10/25/2017
 * Time: 3:09 PM
 */
class AnhNT9_Slider_IndexController extends Mage_Core_Controller_Front_Action{
    public function indexAction(){
        $order = Mage::getModel('anhnt9_slider/image')
            ->getCollection();
        var_dump($order);
        die();
    }
}
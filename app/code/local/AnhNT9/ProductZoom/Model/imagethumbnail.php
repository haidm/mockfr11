<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 11/22/2017
 * Time: 2:47 PM
 */
class AnhNT9_ProductZoom_Model_Imagethumbnail extends Mage_Core_Model_Config_Data{


    public function save() {
        $number = $this->getValue(); //get the value from our config
        $number = preg_replace('#[^0-9]#','',$number); //strip non numeric
        if($number > 100)   //exit if we're less than 10 digits long
        {
            Mage::getSingleton('core/session')->addError('Input numbers contains less than 100px.  Please check your new value and change if desired.');
            return;
        }
        if($number < 50)   //exit if we're less than 10 digits long
        {
            Mage::getSingleton('core/session')->addError('Input numbers contains more than 50px.  Please check your new value and change if desired.');
            return;
        }

        return parent::save();
    }
}
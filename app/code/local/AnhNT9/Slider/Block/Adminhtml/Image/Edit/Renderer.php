<?php

/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 11/1/2017
 * Time: 3:52 PM
 */
class AnhNT9_Slider_Block_Adminhtml_Image_Edit_Renderer extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        $value = $row->getData($this->getColumn()->getIndex());
        if($value){
            return "<img width='75px' height = '75px' src='" .$value. "' />";
        }
        if ($row->getId()) {
            $row->getData($this->getColumn()->getIndex());
            return "<img width='75px' height = '75px' src='" .$value. "' />";
//            $imageName = $row->getAfterImage();
//            $imagePath = Mage::getBaseUrl("media") . $imageName;
//            $dirImg = Mage::getBaseDir() . str_replace("/", DS, strstr($imagePath, '/media'));
//            if (file_exists($dirImg) && !empty($imageName)) {
////                return "<img width='100px' height='100px' src='" . Mage::getBaseUrl("media") . $imageName . "' />";
//            }
        }else{
            $row->getData($this->getColumn()->getIndex());
            return "<img width='75px' height = '75px' src='" .$value. "' />";
        }
    }
}
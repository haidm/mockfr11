<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 11/27/2017
 * Time: 7:54 PM
 */

class AnhNT9_Slider_Block_Adminhtml_Image_Renderer_Image extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)   {
        $html = '<img id="' . $this->getColumn()->getId() . '" src="'.Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA).$row->getData($this->getColumn()->getIndex()) . '"';
        $html .= '/>';
        return $html;
    }
}
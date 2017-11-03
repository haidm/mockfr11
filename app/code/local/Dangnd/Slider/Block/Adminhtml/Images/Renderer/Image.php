<?php
/**
 * Created by PhpStorm.
 * User: nddang196
 * Date: 26-10-2017
 * Time: 04:06 CH
 */

class Dangnd_Slider_Block_Adminhtml_Images_Renderer_Image
    extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        return $this->_getValue($row);
    }

    protected function _getValue(Varien_Object $row)
    {
        $out = '';

        if($row->getId()) {
            $val = $row->getData()['name'];
            $url = Mage::getBaseUrl('media') . 'dangnd/slide/' . $val;
            $out = "<img src=". $url ." width='87px'/>";
        }

        return $out;
    }
}
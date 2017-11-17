<?php

class SM_Slider_Block_Adminhtml_Image_Renderer_GridImage extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        $val = $row->getData();
        $out = "<img src=". $val['link'] ." width='100px'/>";
        return $out;
    }
}
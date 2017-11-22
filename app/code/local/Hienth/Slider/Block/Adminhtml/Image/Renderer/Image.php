<?php
class Hienth_Slider_Block_Adminhtml_Image_Renderer_Image extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        $imageName = $row->getName();
        $imageName = str_replace(' ','',$imageName);
        $imageName = str_replace('(','_',$imageName);
        $imageName = str_replace(')','_',$imageName);
        $val = Mage::getBaseUrl('media').'hienth/image/'.$imageName;
        $out = "<img src=". $val ." width='150px' />";
        return $out;
    }
}
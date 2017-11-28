<?php
class Hienth_Slider_Block_Adminhtml_Slider_Renderer_Slider extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        var_dump($row);die;
        $arrImg = explode('-',$row->list_image);
        $model = Mage::getModel('Hienth_Slider/image');
        foreach ($arrImg as $Img)
        {
            $imageName = $model->load($Img)->getName();
            $val = Mage::getBaseUrl('media').'hienth/image/'.$imageName;
            $out[] = "<img src=". $val ." width='150px' />";
        }
        $output = implode('-',$out);
        return $output;
    }
}
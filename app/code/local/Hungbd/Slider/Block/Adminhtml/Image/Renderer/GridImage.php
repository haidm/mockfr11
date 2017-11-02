<?php
/**
 * Created by PhpStorm.
 * User: hungbui
 * Date: 01/11/2017
 * Time: 15:36
 */
/**
 * Slider Render Image Grid
 * @category    Hungbd
 * @package     Hungbd_Slider_Adminhtml
 * @author      hungbd <hungbd@smartosc.com>
 */
class Hungbd_Slider_Block_Adminhtml_Image_Renderer_GridImage extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        $val = $row->getData();
        $out = "<img src=". $val['link'] ." width='100px'/>";
        return $out;
    }
}
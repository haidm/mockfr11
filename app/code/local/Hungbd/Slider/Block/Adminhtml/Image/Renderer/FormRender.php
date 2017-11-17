<?php
/**
 * Created by PhpStorm.
 * User: hungbui
 * Date: 17/11/2017
 * Time: 16:36
 */
/**
 * Slider Image Form
 * @category    Hungbd
 * @package     Hungbd_Megamenu_Adminhtml
 * @author      hungbd <hungbd@smartosc.com>
 */
class Hungbd_Slider_Block_Adminhtml_Image_Renderer_FormRender extends Mage_Adminhtml_Block_Widget
    implements Varien_Data_Form_Element_Renderer_Interface
{
    public function render(Varien_Data_Form_Element_Abstract $element)
    {
        $id = $element->getIdFieldName();
        $name = $element->getName();
        $value = $element->getData('value');
        $html = '<div style="margin-bottom: 10px">';
        $html .= "<img src='$value' style='height: 40px; width: 80px;'>";
        $html .= "<input type='file' name='$name' value='$value' id='$id' style='margin-left: 130px;'> <br>";
        $html .= '</div>';
        return $html;

    }

}
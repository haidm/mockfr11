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
        $class = $element->getData('class');
        $value = $element->getData('value');
        if (!$value){
            $value = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA).'hung_bd/no-preview-available.png';
        }
        $html = '<div style="margin-bottom: 10px">';
        $html .= "<img id='hungbd-preview-image' src='$value' style='height: 40px; width: 80px;'>";
        $html .= " Delete <input type='checkbox' name='deleteimg' value='1'>";
        $html .= "<input type='file' class='$class' name='$name' id='$id' style='margin-left: 75px;' onchange='loadFile(event)'> <br>";
        $html .= '</div>';
        return $html;

    }

}
<?php
/**
 * Created by PhpStorm.
 * User: hungbui
 * Date: 01/11/2017
 * Time: 15:52
 */

/**
 * Slider Image Form
 * @category    Hungbd
 * @package     Hungbd_Megamenu_Adminhtml
 * @author      hungbd <hungbd@smartosc.com>
 */
class Hungbd_Slider_Block_Adminhtml_Slider_Renderer_FormImage extends Mage_Adminhtml_Block_Widget
    implements Varien_Data_Form_Element_Renderer_Interface
{
    public function render(Varien_Data_Form_Element_Abstract $element)
    {
        $id = $element->getIdFieldName();
        $name = $element->getName();
        $value = $element->getData('value');
        $link = $element->_getData('label');
        $html = '<div>';
        $html .= "<img src='$link' style='height: 40px; width: 80px;'>";
        if ($name == 'listimage[]') {
            $html .= "<input type='checkbox' name='$name' value='$value' checked id='$id' style='margin-left: 10px;'> <br>";
        }
        else{
            $html .= "<input type='checkbox' name='$name' value='$value' id='$id' style='margin-left: 10px;'> <br>";
        }
        $html .= '</div>';
        return $html;

    }

}
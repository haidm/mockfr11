<?php
/**
 * Created by PhpStorm.
 * User: hungbui
 * Date: 17/11/2017
 * Time: 15:05
 */
/**
 * Slider Image Form
 * @category    Hungbd
 * @package     Hungbd_Megamenu_Adminhtml
 * @author      hungbd <hungbd@smartosc.com>
 */
class Hungbd_Slider_Block_Adminhtml_Slider_Renderer_TextRender extends Mage_Adminhtml_Block_Widget
    implements Varien_Data_Form_Element_Renderer_Interface
{
    public function render(Varien_Data_Form_Element_Abstract $element)
    {
        $form = $element->getDefaultHtml();
        return $form;

    }

}
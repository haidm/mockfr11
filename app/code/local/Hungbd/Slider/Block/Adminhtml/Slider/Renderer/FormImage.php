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
class Hungbd_Slider_Block_Adminhtml_Slider_Renderer_FormImage extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        if ($row->getId()) {
            $imageName = $row->getAfterImage();
            $imagePath = Mage::getBaseUrl("media") . $imageName;
            $dirImg = Mage::getBaseDir() . str_replace("/", DS, strstr($imagePath, '/media'));
            if (file_exists($dirImg) && !empty($imageName)) {
                return "";
            } else {
                return "";
            }
        }
    }

}
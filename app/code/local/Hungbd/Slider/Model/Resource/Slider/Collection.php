<?php
/**
 * Created by PhpStorm.
 * User: hungbui
 * Date: 29/10/2017
 * Time: 16:17
 */
/**
 * Hungbd_Slider Slider Collection
 *
 * @category   Hungbd
 * @package    Hungbd_MegaMenu
 * @author      hungbd <hungbd@smartosc.com>
 */
class Hungbd_Slider_Model_Resource_Slider_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    protected function _construct()
    {
        $this->_init('hungbd_slider/image');
    }
}
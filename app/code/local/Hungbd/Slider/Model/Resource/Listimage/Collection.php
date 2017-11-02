<?php
/**
 * Created by PhpStorm.
 * User: hungbui
 * Date: 30/10/2017
 * Time: 09:37
 */
/**
 * Hungbd_Slider Listimage Collection
 *
 * @category   Hungbd
 * @package    Hungbd_MegaMenu
 * @author      hungbd <hungbd@smartosc.com>
 */
class Hungbd_Slider_Model_Resource_Listimage_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    protected function _construct()
    {
        $this->_init('hungbd_slider/listimage');
    }
}
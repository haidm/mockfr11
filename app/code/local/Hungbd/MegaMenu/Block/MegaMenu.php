<?php
/**
 * Created by PhpStorm.
 * User: hungbui
 * Date: 28/10/2017
 * Time: 19:52
 */

/**
 * Mega Menu Block
 * @category    Hungbd
 * @package     Hungbd_Megamenu
 * @author      hungbd <hungbd@smartosc.com>
 */
class Hungbd_MegaMenu_Block_MegaMenu extends Mage_Page_Block_Html_Topmenu
{
    public function __construct()
    {
        parent::__construct();
        if (Mage::getStoreConfig('general/hungbd_megamenu/enable')){
            $this->setTemplate('mytemplate/megamenu/megamenu.phtml');
        }
        else{
            $this->setTemplate('page/html/topmenu.phtml');
        }
    }

    /**
     * Get child category function
     * @param object $menuitem
     * @param integer $maxLevel
     * @param Collection $listMenuItem
     * @return void
     */
    public function getChildItem($menuItem, $maxLevel, $listMenuItem)
    {
        if ($menuItem->level >= $maxLevel || $menuItem->hiden) {
            return;
        }
        if ($this->hasChildren($menuItem->id)){
            echo "<ul>";
            foreach ($listMenuItem as $key => $item) {
                if ($item->parent_id == $menuItem->id) {
                    echo "<li>";
                    echo "<a href='$item->link'>$item->name</a>";
                    $this->getChildItem($item, $maxLevel, $listMenuItem);
                    echo "</li>";
                }
            }
            echo "</ul>";
        }
    }

    /**
     * Check item has children
     * @param integer $menuItemId
     * @return boolean
     */
    public function hasChildren($menuItemId)
    {
        $child = Mage::getModel('hungbd_megamenu/menuitem')
            ->getCollection()
            ->addFilter('parent_id', $menuItemId);
        if ($child->count() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
<?php

class Tungtt_MegaMenu_Block_MegaMenu extends Mage_Core_Block_Template
{
    /**
     * Get child category function
     * @param object $menuitem
     * @param integer $maxLevel
     * @param Collection $listMenuItem
     * @return void
     */
    public function getChildItem($menuItem, $maxLevel, $listMenuItem)
{
    if ($menuItem->level >= $maxLevel) {
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
        $child = Mage::getModel('tungtt_megamenu/menuitem')
            ->getCollection()
            ->addFilter('parent_id', $menuItemId);
        if ($child->count() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
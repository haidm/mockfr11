<?php
/**
 * Created by PhpStorm.
 * User: hungbui
 * Date: 21/11/2017
 * Time: 10:37
 */
class Hungbd_MegaMenu_Helper_Menu extends Mage_Core_Helper_Abstract
{
    public function getListLabel($item,$label,$slash,$menuitem)
    {
        $slash = $slash.'-';
        $label .= $slash.$item->name."($item->id),";
        foreach ($menuitem as $test){
            if ($item->id == $test->parent_id){
                $newstring = '';
                $label .= $this->getListLabel($test,$newstring,$slash,$menuitem);
            }
        }
        return $label;
    }

    public function getListValue($item,$value,$slash,$menuitem)
    {
        $value .= $item->id.',';
        foreach ($menuitem as $test){
            if ($item->id == $test->parent_id){
                $newstring = '';
                $value .= $this->getListValue($test,$newstring,$slash,$menuitem);
            }
        }
        return $value;
    }

    public function getListMenu()
    {
        $menulist = Mage::getModel('hungbd_megamenu/menuitem')->getCollection();
        $topmenu = Mage::getModel('hungbd_megamenu/menuitem')->getCollection()
            ->addFieldToFilter('parent_id',0);
        $test = '';
        $test1 = '';
        foreach ($topmenu as $item){
            $test .= $this->getListLabel($item,'','',$menulist);
            $test1 .= $this->getListValue($item,'','',$menulist);
        }
        $test = rtrim($test,',');
        $test1 = rtrim($test1,',');
        $label = explode(',',$test);
        $value = explode(',',$test1);
        $menu = array_combine($value,$label);
        return $menu;
    }
}
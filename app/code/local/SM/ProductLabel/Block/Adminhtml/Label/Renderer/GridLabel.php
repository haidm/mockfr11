<?php

class SM_ProductLabel_Block_Adminhtml_Label_Renderer_GridLabel extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        $val = $row->getData();
        $out = $val['content'];
        return $out;
    }
}
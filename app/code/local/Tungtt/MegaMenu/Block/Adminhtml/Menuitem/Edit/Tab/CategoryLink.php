<?php

class Tungtt_MegaMenu_Block_Adminhtml_Menuitem_Edit_Tab_CategoryLink extends Mage_Adminhtml_Block_Widget_Form
{

    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $menuItem = Mage::registry('menuitem_model');
        $model = Mage::registry('category');
        $datas = $this->showCategories($model, 2, '', $menuItem);

        $this->setForm($form);
        $fieldset = $form->addFieldset('menuitem_form',
            array('legend' => 'Category link'));
        $fieldset->addField('category_id', 'select',
            array(
                'name' => 'category_id',
                'label' => 'Category',
                'values' => $datas['cate'],
                'value' => $datas['select'],
                'class' => 'required-entry validate-select validate-digits validate-greater-than-zero validate-length maximum-length-10 minimum-length-1',
                'required' => true,
            ));

        return parent::_prepareForm();
    }

    public function showCategories($data, $parent_id = 2, $char = '', $menuItem)
    {
        GLOBAL $cate;
        GLOBAL $select;
        foreach ($data as $key => $item) {

            // Nếu là chuyên mục con thì hiển thị
            if ($item->parent_id == $parent_id) {
                $cate[$key]['label'] = $char . $item->name;
                $cate[$key]['value'] = $item->getId();
                if ($menuItem->getName() == $item->name) {
                    $select = $item->getId();
                }

                // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
                $this->showCategories($data, $cate[$key]['value'], $char . '|--', $menuItem);
            }
        }
        return array('cate' => $cate,'select' => $select);
    }
}
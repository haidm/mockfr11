<?php

class Tungtt_MegaMenu_Block_Adminhtml_Menuitem_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{

    public function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $model = Mage::registry('menuitem_model');
        $newmodel = Mage::registry('menuitem_type');
        $menuItemList = Mage::registry('menuitem_list');
        $select = 0;
        $selectData = $this->showCategories($menuItemList, 0, '', $model);
        $selectData[0]['label'] = 'None';
        $selectData[0]['value'] = 0;

        $fieldset = $form->addFieldset('menuitem_form',
            array('legend' => 'Menu item infomation'));

        $fieldset->addField('parent_id', 'select',
            array(
                'name' => 'parent_id',
                'label' => 'Parent',
                'values' => $selectData,
                'value' => $select,
                'class' => 'required-entry validate-select validate-digits validate-digits-range digits-range-0-999999',
                'required' => true,
            ));

        if ($newmodel) {
            $fieldset->addField('type', 'hidden', array(
                'name' => 'type',
                'label' => 'type',
                'value' => $newmodel,
                'class' => 'required-entry validate-select',
                'required' => true,
            ));
        }

        if ($model->getId()) {
            $fieldset->addField('id', 'hidden',
                array(
                    'name' => 'id',
                    'label' => Mage::helper('core')->__('Id')
                )
            );
            $fieldset->addField('type', 'hidden', array(
                'name' => 'type',
                'label' => 'type',
            ));
        }

        $form->addValues($model->getData());
        return parent::_prepareForm();
    }

    public function showCategories($data, $parent_id = 0, $char = '', $model)
    {
        GLOBAL $selectData;
        foreach ($data as $key => $item) {
            // Nếu là chuyên mục con thì hiển thị
            if ($item->parent_id == $parent_id) {
                $selectData[$key]['label'] = $char . $item->name;
                $selectData[$key]['value'] = $item->id;
//                echo $selectData[$key]['label'];
//                if ($item->id == $model->getParentid()){
//                    $select = $item->id;
//                }
                // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
                $this->showCategories($data, $selectData[$key]['value'], $char . '|--', $model);
            }
        }
        return $selectData;
    }
}

<?php

/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 11/2/2017
 * Time: 2:35 PM
 */
class AnhNT9_Slider_Block_Slider extends Mage_Core_Block_Template
{
    public function getListDataSlider()
    {
        $typeSlider = Mage::getStoreConfig('catalog/slider/select_slider');
        if (isset($typeSlider) && $typeSlider != "") {
            $slider = Mage::getModel('anhnt9_slider/slider')->getCollection()->addFieldToFilter('slider_id', $typeSlider)->getData();

            $sliderActive = Mage::getModel('anhnt9_slider/slider')->getCollection()->addFieldToFilter('status', 1)->getColumnValues('slider_id');
            if ($slider[0]['slider_id'] != $sliderActive[0]) {
                $dataById = Mage::getModel('anhnt9_slider/slider')->getCollection()->addFieldToFilter('slider_id', $sliderActive[0])->getData();
                $dataById[0]['status'] = 0;
                $slider[0]['status'] = 1;
                $convertActive = Mage::getModel('anhnt9_slider/slider');
                $saveConfig = Mage::getModel('anhnt9_slider/slider');
                $saveConfig->setData($slider[0]);
                $saveConfig->save();
                $convertActive->setData($dataById[0]);
                $convertActive->save();
            } else {
                $data = Mage::getModel('anhnt9_slider/image')->getCollection()
                    ->join(array('slider' => 'anhnt9_slider/slider2'),
                        'main_table.sl_id=slider.slider_id',
                        array('name_slider', 'status'))->addFieldToFilter('status', 1);
                return $data;
            }
        }
        $data = Mage::getModel('anhnt9_slider/image')->getCollection()
            ->join(array('slider' => 'anhnt9_slider/slider2'),
                'main_table.sl_id=slider.slider_id',
                array('name_slider', 'status'))->addFieldToFilter('status', 1);
        return $data;
    }
}
<?php
/**
 * User: nddang
 * Date: 01-11-2017
 * Time: 3:01 CH
 */

class Dangnd_Slider_Model_ChooseSlide
{
    public function toOptionArray()
    {
        $slide = Mage::getModel('dangnd_slider/slide')->getCollection()->toArray();
        $data = [];

        foreach ($slide['items'] as $item) {
            $data[] = [
                'label' => $item['name'],
                'value' => $item['id']
            ];
        }

        return $data;
    }
}
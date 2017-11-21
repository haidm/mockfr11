<?php
/**
 * Created by PhpStorm.
 * User: nddang
 * Date: 31-10-2017
 * Time: 4:56 CH
 */

class Dangnd_Slider_Block_Adminhtml_Slide_Edit_Tab_Images extends Mage_Adminhtml_Block_Widget_Form
{
    public function _prepareForm()
    {
        $model = Mage::registry('imgModel');
        $slide = Mage::registry('slideModel');

        $form = new Varien_Data_Form();

        $fieldset = $form->addFieldset('base', array(
            'legend' => Mage::helper('dangnd_slider')->__('Images of Slide')
        ));
        $fieldset->addType('image', 'Dangnd_Slider_Block_Adminhtml_Helper_Image');
        if ($slideId = $slide->getId()) {
            $slideImg = $model->getCollection()->addFilter("slideId", $slideId);

            foreach ($slideImg as $item) {
                $html = $this->imagesHtml($item);
                $fieldset->addField('image' . $item->getId(), 'image', array(
                    'name'               => "imgEdit[{$item->getId()}]",
                    'label'              => Mage::helper('dangnd_slider')->__('Image'),
                    'class'              => 'required-entry',
                    'onchange'           => "readOne(this, 'img' + {$item->getId()}, 0);",
                    'after_element_html' => $html
                ));
            }
        }
        $fieldset->addField('image', 'image', array(
            'name'               => 'image[]',
            'label'              => Mage::helper('dangnd_slider')->__('New Images'),
            'class'              => 'required-entry',
            'multiple'           => 'multiple',
            'onchange'           => "readMulti(this);",
            'after_element_html' => "<div id='newImg'></div>"
        ));

        $form->addValues($model->getData());
        $this->setForm($form);

        return parent::_prepareForm();
    }

    public function imagesHtml($image)
    {
        $pathImg = Mage::getBaseUrl('media') . 'dangnd/slide/' . $image->getName();
//        $visible = empty($image->getVisible()) ? '' : 'true';
        $html = '<br />';
        $html .= "<img id='img{$image->getId()}' src='{$pathImg}' height='100px'/>";
        $html .= "<div><input type='checkbox' value='{$image->getId()}' name='delImg[]' /> Delete</div>";
//        $html .= "<span style='margin-right: 30px'> Delete</span>";
//        $html .= "<input type='checkbox' value='{$image->getId()}' name='visibleImg[]' checked='{$visible}' />";
//        $html .= " <span> Is Visible</span></div>";

        return $html;
    }
}
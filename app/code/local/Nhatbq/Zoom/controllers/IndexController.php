<?php 
/**
* 
*/
class Nhatbq_Zoom_IndexController extends Mage_Core_Controller_Front_Action
{
	
	 public function indexAction(){
        $this->loadLayout('nhatbq_zoom');
        $this->renderLayout();
    }
}
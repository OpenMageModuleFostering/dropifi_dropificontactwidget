<?php
  class Dropifi_Dropificontactwidget_Adminhtml_DropifiController extends Mage_Adminhtml_Controller_Action
  {      
      public function indexAction(){
          $this->loadLayout()
          ->_setActiveMenu('dropificontactwidget/Dropifi Contact Widget');
          $this->renderLayout();
      }
      
      public function signupAction()
      {
		$data = $this->getRequest()->getPost();
          
          if($data){
              try{
                                     
                  if($data['status'] == 200){
                      $model = Mage::getModel('dropifi_dropificontactwidget/dropificontactwidget')->load(1);
                      if($model){
                          $model->setEmail($data['userEmail'])
                          ->setPassword($data['password'])
                          ->setDropifi_pkey($data['publicKey'])
                          ->setDropifi_lurl("http://www.dropifi.com/ecommerce/magento/login/?temToken=".$data['temToken']."&userEmail=".$data['userEmail'])
                          ->setCreated_at(Varien_Date::now())
                          ->save();   
                      }
                      $this->_redirect('dropificontactwidget/adminhtml_dropifi/index',array('response'=>$data['msg']));
                  }
                  else{
                      $this->_redirect('dropificontactwidget/adminhtml_dropifi/index',array('response'=>$data['msg']));
                  }
              }
              catch(Mage_Core_Exception $e) {
                  $this->_getSession()->addError($e->getMessage());
                  $this->_redirect('dropificontactwidget/adminhtml_dropifi/index');
              } 
          }
      }
      
      public function loginAction()
      {
          $data = $this->getRequest()->getPost();
          
          if($data){
              try{
                                     
                  if($data['status'] == 200){
                      $model = Mage::getModel('dropifi_dropificontactwidget/dropificontactwidget')->load(1);
                      if($model){
                          $model->setEmail($data['userEmail'])
                          ->setPassword($data['password'])
                          ->setDropifi_pkey($data['publicKey'])
                          ->setDropifi_lurl("http://www.dropifi.com/ecommerce/magento/login/?temToken=".$data['temToken']."&userEmail=".$data['userEmail'])
                          ->setCreated_at(Varien_Date::now())
                          ->save();   
                      }
                      $this->_redirect('dropificontactwidget/adminhtml_dropifi/index',array('response'=>$data['msg']));
                  }
                  else{
                      $this->_redirect('dropificontactwidget/adminhtml_dropifi/index',array('response'=>$data['msg']));
                  }
              }
              catch(Mage_Core_Exception $e) {
                  $this->_getSession()->addError($e->getMessage());
                  $this->_redirect('dropificontactwidget/adminhtml_dropifi/index');
              } 
          }
      }
      
      public function resetAction()
      {
          try{
              $model = Mage::getModel('dropifi_dropificontactwidget/dropificontactwidget')->load(1);
              if($model){
                  $model->setEmail("")
                  ->setPassword("")
                  ->setDropifi_pkey("")
                  ->setDropifi_lurl("")
                  ->setCreated_at("")
                  ->save();
              }
              $this->_redirect('dropificontactwidget/adminhtml_dropifi/index',array('response'=>'You have reset the account.')); 
          }
          catch(Mage_Core_Exception $e){
              $this->_redirect('dropificontactwidget/adminhtml_dropifi/index',array('response'=>$e->getMessage()));
          } 
      }
  }
?>

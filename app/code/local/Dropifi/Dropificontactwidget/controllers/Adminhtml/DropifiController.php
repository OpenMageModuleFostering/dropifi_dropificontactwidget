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
          $file = Mage::getModuleDir('','Dropifi_Dropificontactwidget').DS.'lib'.DS.'dropifi_install.php';
          require_once($file);
          $send = new DropifiMagento();          
          
          $data = $this->getRequest()->getPost();
          
          if($data){
              try{
                  $parameters  = array(
                        'displayName'      => $data['fullname'],
                        'user_email'       => $data['email'],
                        'user_domain'      => $data['storeDomain'],
                        'user_password'    => $data['password'],
                        'user_re_password' => $data['repassword'],
                        'hostUrl'          => $data['hostUrl'],
                        'requestUrl'       => $data['requestUrl'],
                        'accessToken'      => substr(str_shuffle(MD5($data['email'] . $data['storeDomain']. $data['password'])), 0, 10),
                        'site_url'         => $data['siteUrl']
                      );
                 
                  $resData = $send->rest_helper('http://www.dropifi.com/ecommerce/magento/signup',$parameters,"POST");
                                   
                  if($resData->status == 200){
                      $model = Mage::getModel('dropifi_dropificontactwidget/dropificontactwidget')->load(1);
                      if($model){
                          $model->setEmail($resData->userEmail)
                          ->setPassword($data['password'])
                          ->setDropifi_pkey($resData->publicKey)
                          ->setDropifi_lurl("http://www.dropifi.com/ecommerce/magento/login/?temToken=".$resData->temToken."&userEmail=".$resData->userEmail)
                          ->setCreated_at(Varien_Date::now())
                          ->save();   
                      }
                      $this->_redirect('dropificontactwidget/adminhtml_dropifi/index',array('response'=>$resData->msg));
                  }
                  else{
                      $this->_redirect('dropificontactwidget/adminhtml_dropifi/index', array('response'=>$resData->msg));
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
          $file = Mage::getModuleDir('','Dropifi_Dropificontactwidget').DS.'lib'.DS.'dropifi_install.php';
          require_once($file);
          $send = new DropifiMagento();          
          
          $data = $this->getRequest()->getPost();
          
          if($data){
              try{
                  $parameters  = array(
                        'login_email'      => $data['login_email'],
                        'accessKey'        => MD5($data['password']),
                        'requestUrl'       => $data['requestUrl'],
                        'accessToken'      => substr(str_shuffle(MD5($data['login_email'] . $data['password'])), 0, 10),
                        'site_url'         => $data['siteUrl']
                      );
                  
                  $resData = $send->rest_helper('http://www.dropifi.com/ecommerce/magento/loginToken',$parameters,"POST");
                  
                  if($resData->status == 200){
                      $model = Mage::getModel('dropifi_dropificontactwidget/dropificontactwidget')->load(1);
                      if($model){
                          $model->setEmail($resData->userEmail)
                          ->setPassword($data['password'])
                          ->setDropifi_pkey($resData->publicKey)
                          ->setDropifi_lurl("http://www.dropifi.com/ecommerce/magento/login/?temToken=".$resData->temToken."&userEmail=".$resData->userEmail)
                          ->setCreated_at(Varien_Date::now())
                          ->save();   
                      }
                      $this->_redirect('dropificontactwidget/adminhtml_dropifi/index',array('response'=>$resData->msg));
                  }
                  else{
                      $this->_redirect('dropificontactwidget/adminhtml_dropifi/index',array('response'=>$resData->msg));
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

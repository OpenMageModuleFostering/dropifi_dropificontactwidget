<?php
class Dropifi_Dropificontactwidget_Block_Adminhtml_Dropifiblock extends Mage_Core_Block_Template
{
    public $storeName = "";
    public $storeEmail = "";
    public $storeDomain = "";
    public $storeUrl = "";   
    
    public function NeededDetails(){
        $website = null;
        $websites = Mage::app()->getWebsites();
        if(count($websites) > 0){
            foreach($websites as $website){
                $this->storeDomain = $website->getName();
                $this->storeUrl    = $website->getDefaultStore()->getBaseUrl();
                $this->storeName   = $website->getDefaultStore()->getName();
                break;
            }            
        }         
    }
    
    public function getStoreName(){ return $this->storeName; }
    public function getStoreEmail(){ return $this->storeEmail; }
    public function getStoreDomain(){ return $this->storeDomain; }
    public function getStoreUrl(){ return $this->storeUrl; }                                           
}
?>
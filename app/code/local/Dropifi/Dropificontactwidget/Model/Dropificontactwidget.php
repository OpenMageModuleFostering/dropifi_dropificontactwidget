<?php
class Dropifi_Dropificontactwidget_Model_Dropificontactwidget extends Mage_Core_Model_Abstract
{
    public function _construct(){ 
        $this->_init('dropifi_dropificontactwidget/dropificontactwidget');
    }
         
    protected function _beforeSave()
    {
        parent::_beforeSave();
        if ($this->isObjectNew()) {
            $this->setData('created_at', Varien_Date::now());
        }
        return $this;
    }
}
?>

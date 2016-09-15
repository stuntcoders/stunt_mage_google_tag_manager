<?php

class Stuntcoders_Googleanalytics_Helper_Data extends Mage_Core_Helper_Abstract
{
    public function isEnabled()
    {
        return Mage::getStoreConfigFlag("stuntcoders_googleanalytics/general_options/enable");
    }

    public function getAccNumber()
    {
        return Mage::getStoreConfig("stuntcoders_googleanalytics/general_options/acount_num");
    }

    public function isGaEnabled()
    {
        return $this->isEnabled() && Mage::getStoreConfig("stuntcoders_googleanalytics/general_options/type") == 0;
    }

    public function isGtmEnabled()
    {
        return $this->isEnabled() && Mage::getStoreConfig("stuntcoders_googleanalytics/general_options/type") == 1;
    }
}

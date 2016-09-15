<?php

class Stuntcoders_Googleanalytics_Model_System_Config_Source_Options
{
    public function toOptionArray()
    {
        return array(
            array('value' => 1, 'label'=>Mage::helper('adminhtml')->__('Google Tag Manager')),
            array('value' => 0, 'label'=>Mage::helper('adminhtml')->__('Google Analytics')),
        );
    }

    public function toArray()
    {
        return array(
            1 => Mage::helper('adminhtml')->__('Google Tag Manager'),
            0 => Mage::helper('adminhtml')->__('Google Analytics'),
        );
    }
}

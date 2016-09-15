<?php
class Stuntcoders_Googleanalytics_Model_Observer
{
    public function setGoogleanalyticsOnOrderSuccessPageView(Varien_Event_Observer $observer)
    {
        $orderIds = $observer->getEvent()->getOrderIds();
        if (empty($orderIds) || !is_array($orderIds)) {
            return;
        }
        $block = Mage::app()->getFrontController()
            ->getAction()
            ->getLayout()
            ->getBlock('stuntcoders.googleanalytics.ga');

        if ($block) {
            $block->setOrderIds($orderIds);
        }

        $block = Mage::app()->getFrontController()
            ->getAction()
            ->getLayout()
            ->getBlock('stuntcoders.googleanalytics.gtm');

        if ($block) {
            $block->setOrderIds($orderIds);
        }
    }
}

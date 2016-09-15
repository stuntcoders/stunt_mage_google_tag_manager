<?php

class Stuntcoders_Googleanalytics_Block_Googleanalytics_Gtm extends Stuntcoders_Googleanalytics_Block_Googleanalytics
{
    public function getEcommerceSnippet()
    {
        if (!$this->getOrderIds()) {
            return "";
        }

        $output = "dataLayer = ";

        $orderIds = $this->getOrderIds();
        foreach ($orderIds as $orderId) {
            $order = Mage::getModel('sales/order')->load($orderId);
            $output .= $this->_getGtmTransactionDataLayer($order);
        }

        return "<script>{$output};</script>";
    }

    private function _getGtmTransactionDataLayer($order)
    {
        $items = array();
        foreach ($order->getAllVisibleItems() as $item) {
            $items[] = $this->_toGtmDataLayer($item);
        }

        $k = json_encode(array(array(
            'transactionId'         => $order->getIncrementId(),
            'transactionTotal'      => $order->getGrandTotal(),
            'transactionTax'        => $order->getTaxAmount(),
            'transactionShipping'   => $order->getShippingAmount(),
            'transactionProducts'   => $items,
        )));

        return $k;
    }

    private function _toGtmDataLayer($item)
    {
        $output = array(
            'name'     => $item->getName(),
            'sku'      => $item->getSku(),
            'price'    => $item->getPriceInclTax(),
            'quantity' => $item->getQtyOrdered(),
        );

        return $output;
    }
}

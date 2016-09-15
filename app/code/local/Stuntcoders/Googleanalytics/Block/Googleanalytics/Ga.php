<?php

class Stuntcoders_Googleanalytics_Block_Googleanalytics_Ga extends Stuntcoders_Googleanalytics_Block_Googleanalytics
{
    public function getEcommerceSnippet()
    {
        if (!$this->getOrderIds()) {
            return "";
        }

        $output = "ga('require', 'ecommerce');\n";

        $orderIds = $this->getOrderIds();
        foreach ($orderIds as $orderId) {
            $order = Mage::getModel('sales/order')->load($orderId);

            $output .= $this->_getGaTransactionJs($order);

            $items = $order->getAllVisibleItems();
            foreach ($items as $item) {
                $output .= $this->_getGaItemJs($order->getIncrementId(), $item);
            }
        }

        $output .= "ga('ecommerce:send');\n";

        return $output;
    }

    private function _getGaTransactionJs($order)
    {
        $transaction = json_encode(array(
            'id'        => $order->getIncrementId(),
            'revenue'   => $order->getGrandTotal(),
            'tax'       => $order->getTaxAmount(),
            'shipping'  => $order->getShippingAmount(),
        ));

        return "ga('ecommerce:addTransaction', {$transaction});\n";
    }

    private function _getGaItemJs($orderId, $item)
    {
        $item = json_encode(array(
            'id'       => $orderId,
            'name'     => $item->getName(),
            'sku'      => $item->getSku(),
            'price'    => $item->getPriceInclTax(),
            'quantity' => $item->getQtyOrdered(),
        ));

        return "ga('ecommerce:addItem', {$item});\n";
    }
}

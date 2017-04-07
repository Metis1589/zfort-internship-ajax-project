<?php
namespace common\helpers;

use Yii;
use common\models\Order;
use common\models\OrderItem;

class Cart
{

    public static function getOrder()
    {
        if (!($order = Yii::$app->session->get('order'))) {
            $order = new Order;
            if ($order->save()) {
                Yii::$app->session->set('order', $order);
            }
        }
        $orderItems = Yii::$app->session->get('orderItems', []);
        return [$order, $orderItems];
    }

    public static function addProduct($product, $amount)
    {
        list($order, $orderItems) = self::getOrder();
        $orderItem = self::getOrderProduct($product, $order, $orderItems);
        $orderItem->amount += (int)$amount;
        $orderItem->save(true, ['amount']);
        $orderItems[$orderItem->productId] = $orderItem;
        self::recalculateOrderDetails($order, $orderItems);
        Yii::$app->session->set('orderItems', $orderItems);
    }


    public static function updateProduct($product, $amount)
    {
        list($order, $orderItems) = self::getOrder();
        $orderItem = self::getOrderProduct($product, $order, $orderItems);
        $orderItem->amount = (int)$amount;
        $orderItem->save(true, ['amount']);
        $orderItems[$orderItem->productId] = $orderItem;
        self::recalculateOrderDetails($order, $orderItems);
        Yii::$app->session->set('orderItems', $orderItems);
    }

    public static function deleteProduct($product)
    {
        list($order, $orderItems) = self::getOrder();
        if(isset($orderItems[$product->id])){
            $orderItems[$product->id]->delete();
            unset($orderItems[$product->id]);
        }
        self::recalculateOrderDetails($order, $orderItems);
        Yii::$app->session->set('orderItems', $orderItems);
    }

    private static function recalculateOrderDetails($order, $orderItems){
        $total = 0;
        foreach($orderItems as $orderItem){
            $total += $orderItem->amount * $orderItem->product->price;
        }
        $order->fullPrice = $total;
        if($total > 300){
            $order->discount = round(0.05 * $total);
        }
        elseif($total > 1000){
            $order->discount = round(0.12 * $total);
        }
        else{
            $order->discount = 0;
        }
        if($total < 150){
            $order->deliveryCost = 50;
        }
        else{
            $order->deliveryCost = 0;
        }
        if($total < 100){
            $order->taxCost = 0;
        }
        else{
            $order->taxCost = $total * 0.05;
        }

        $order->totalPrice = $order->fullPrice - $order->discount + $order->deliveryCost + $order->taxCost;
        $order->save(true, ['fullPrice', 'discount', 'deliveryCost', 'taxCost', 'totalPrice']);
        Yii::$app->session->set('order', $order);
    }

    public static function getOrderDetails(){
        list($order, $orderItems) = self::getOrder();
        $cnt = 0;
        foreach($orderItems as $orderItem){
            $cnt += $orderItem->amount;
        }
        return $order->getAttributes(['fullPrice', 'discount', 'deliveryCost', 'taxCost', 'totalPrice']) + ['positions' => $cnt];
    }

    private static function getOrderProduct($product, $order, $orderItems){
        if (!array_key_exists($product->id, $orderItems)) {
            $orderItem = new OrderItem;
            $orderItem->productId = $product->id;
            $orderItem->orderId = $order->id;
            $orderItem->price = $product->price;
            $orderItem->amount = 0;
            $orderItem->save();
        } else {
            $orderItem = $orderItems[$product->id];
        }
        return $orderItem;
    }

}

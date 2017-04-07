<?php
namespace frontend\controllers;

use common\helpers\Cart;
use Yii;

/**
 * CartController
 */
class CartController extends BaseController
{
    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        list($order, $orderItems) = Cart::getOrder();
        return $this->render('index',[
            'order' => $order,
            'orderItems' => $orderItems
        ]);
    }
}

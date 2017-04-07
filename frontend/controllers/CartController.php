<?php
namespace frontend\controllers;

use common\helpers\Cart;
use common\models\Product;
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

    /**
     * Adds position to the cart
     * @return array
     */
    public function actionCreate()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        Cart::addProduct($this->getProduct(), (int)Yii::$app->request->post('amount', 1));
        return $this->successResponse();
    }

    /**
     * Updates position in the cart
     * @return array
     */
    public function actionUpdate()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        Cart::updateProduct($this->getProduct(), (int)Yii::$app->request->post('amount', 1));
        return $this->successResponse();
    }

    /**
     * Deletes position from the cart
     * @return array
     */
    public function actionDelete()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        Cart::removeProduct($this->getProduct());
        return $this->successResponse();
    }

    protected function getProduct(){
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (!($product = Product::findOne(['slug' => Yii::$app->request->post('product')]))) {
            return [
                'success' => false,
                'errors' => ['Selected product is not available at the moment']
            ];
            Yii::$app->end();
        }
        return $product;
    }

    /**
     * @param bool $withCartInfo
     * @return array
     */
    protected function successResponse(){
        return [
            'success' => true,
            'data' => Cart::getOrderDetails()
        ];
    }
}

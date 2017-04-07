<?php

namespace api\modules\v1\controllers;

use Yii;
use api\modules\v1\components\BaseController;
use common\models\Product;
use common\helpers\Cart;

class CartController extends BaseController
{

    /**
     * Adds position to the cart
     * @return array
     */
    public function actionCreate()
    {
        Cart::addProduct($this->getProduct(), (int)Yii::$app->request->post('amount', 1));
        return $this->successResponse(false);
    }

    /**
     * Updates position in the cart
     * @return array
     */
    public function actionUpdate()
    {
        Cart::updateProduct($this->getProduct(), (int)Yii::$app->request->post('amount', 1));
        return $this->successResponse(true);
    }

    /**
     * Deletes position from the cart
     * @return array
     */
    public function actionDelete()
    {
        Cart::removeProduct($this->getProduct());
        return $this->successResponse(true);
    }

    protected function getProduct(){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (!($product = Product::findOne(['slug' => Yii::$app->request->post('product', 'white-blouse')]))) {
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
    protected function successResponse($withCartInfo = false){
        return [
            'success' => true,
            'data' => $withCartInfo ? Cart::getOrderDetails() : []
        ];
    }



}

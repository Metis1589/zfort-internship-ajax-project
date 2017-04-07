<?php

namespace frontend\controllers;

use yii\web\Controller;
use Yii;

class BaseController extends Controller
{
    /**
     * @inheritdoc
     */
    /*
    public function beforeAction($action)
    {
        if(!Yii::$app->session->getId()){
            $client = new \yii\httpclient\Client();
            $response = $client->createRequest()
                ->setMethod('get')
                ->setUrl(Yii::$app->params['api.url'].Yii::$app->params['api.sessionEndPoint'])
                ->send();
            if ($response->isOk) {
                Yii::$app->session->regenerateID($response->data['token']);
            }
        }

        if (!parent::beforeAction($action)) {
            return false;
        }

        echo Yii::$app->session->getId();

        // other custom code here

        return true; // or false to not run the action
    }
    */
}

<?php

namespace techapi\modules\v1\controllers;

use common\models\TechReport;
use Yii;
use api\modules\v1\components\BaseController;
use common\models\Product;
use common\helpers\Cart;
use yii\helpers\Json;

class ReportController extends BaseController
{

    public function actionReport()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSONP;
        $techData = Yii::$app->request->get();
        $model = new TechReport();
        $model->request = Json::encode($techData['request']);
        $model->response = Json::encode($techData['response']);
        $model->statusCode = $techData['statusCode'];
        $model->action = $techData['action'];
        $model->dateTime = $techData['dateTime'];
        return ['data' => $model->save(), 'callback' => $techData['callback']];
    }
}

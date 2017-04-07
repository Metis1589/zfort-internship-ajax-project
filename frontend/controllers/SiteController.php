<?php
namespace frontend\controllers;

use Yii;
use frontend\controllers\BaseController;
use common\models\search\ProductSearch;

/**
 * Site controller
 */
class SiteController extends BaseController
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index',[
            'dataProvider' => (new ProductSearch)->search([])
        ]);
    }
}

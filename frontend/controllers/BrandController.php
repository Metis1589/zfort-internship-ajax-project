<?php
namespace frontend\controllers;

use Yii;
use common\models\search\ProductSearch;
use common\models\Brand;

/**
 * Site controller
 */
class BrandController extends BaseController
{

    /**
     * Displays products for particular brand.
     *
     * @return mixed
     */
    public function actionIndex($slug)
    {
        $model = $this->findModel($slug);
        return $this->render('index',[
            'model' => $model,
            'dataProvider' => (new ProductSearch)->search(['ProductSearch'=>['brandId'=>$model->id]])
        ]);
    }

    /**
     * Finds the Brand model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Brand the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($slug)
    {
        if (($model = Brand::findOne(['slug' => $slug])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

<?php

namespace techapi\modules\v1\components;

use yii\rest\Controller;

class BaseController extends Controller
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'options' => [
                'class' => 'yii\rest\OptionsAction',
            ],
        ];
    }
}

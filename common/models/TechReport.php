<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "techReport".
 *
 * @property int $id
 * @property string $request
 * @property string $response
 * @property int $statusCode
 * @property string $action
 * @property string $dateTime
 * @property string $createdAt
 * @property string $updatedAt
 * @property string $deletedAt
 */
class TechReport extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'techReport';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['request', 'response', 'statusCode', 'action', 'dateTime'], 'required'],
            [['request', 'response'], 'string'],
            [['statusCode'], 'integer'],
            [['dateTime', 'createdAt', 'updatedAt', 'deletedAt'], 'safe'],
            [['action'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'request' => Yii::t('app', 'Request'),
            'response' => Yii::t('app', 'Response'),
            'statusCode' => Yii::t('app', 'Status Code'),
            'action' => Yii::t('app', 'Action'),
            'dateTime' => Yii::t('app', 'Date Time'),
            'createdAt' => Yii::t('app', 'Created At'),
            'updatedAt' => Yii::t('app', 'Updated At'),
            'deletedAt' => Yii::t('app', 'Deleted At'),
        ];
    }
}

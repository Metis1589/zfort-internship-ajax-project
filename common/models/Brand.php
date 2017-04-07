<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "brand".
 *
 * @property integer $id
 * @property integer $status
 * @property string $name
 * @property string $slug
 * @property integer $productCount
 * @property string $createdAt
 * @property string $updatedAt
 * @property string $deletedAt
 */
class Brand extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'brand';
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
            [['status', 'productCount'], 'integer'],
            [['name', 'slug', 'createdAt'], 'required'],
            [['createdAt', 'updatedAt', 'deletedAt'], 'safe'],
            [['name', 'slug'], 'string', 'max' => 128],
            [['name'], 'unique'],
            [['slug'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'status' => Yii::t('app', 'Status'),
            'name' => Yii::t('app', 'Name'),
            'slug' => Yii::t('app', 'Slug'),
            'productCount' => Yii::t('app', 'Product Count'),
            'createdAt' => Yii::t('app', 'Created At'),
            'updatedAt' => Yii::t('app', 'Updated At'),
            'deletedAt' => Yii::t('app', 'Deleted At'),
        ];
    }
}

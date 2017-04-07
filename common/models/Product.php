<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "product".
 *
 * @property integer $id
 * @property integer $status
 * @property string $name
 * @property double $price
 * @property double $priceOld
 * @property string $slug
 * @property integer $categoryId
 * @property integer $brandId
 * @property string $createdAt
 * @property string $updatedAt
 * @property string $deletedAt
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
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
            [['status', 'categoryId', 'brandId'], 'integer'],
            [['name', 'price', 'priceOld', 'slug', 'categoryId', 'brandId', 'createdAt'], 'required'],
            [['price', 'priceOld'], 'number'],
            [['createdAt', 'updatedAt', 'deletedAt'], 'safe'],
            [['name', 'slug'], 'string', 'max' => 128],
            [['name'], 'unique'],
            [['price'], 'unique'],
            [['priceOld'], 'unique'],
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
            'price' => Yii::t('app', 'Price'),
            'priceOld' => Yii::t('app', 'Price Old'),
            'slug' => Yii::t('app', 'Slug'),
            'categoryId' => Yii::t('app', 'Category ID'),
            'brandId' => Yii::t('app', 'Brand ID'),
            'createdAt' => Yii::t('app', 'Created At'),
            'updatedAt' => Yii::t('app', 'Updated At'),
            'deletedAt' => Yii::t('app', 'Deleted At'),
        ];
    }
}

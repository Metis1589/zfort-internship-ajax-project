<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "orderItem".
 *
 * @property integer $id
 * @property integer $orderId
 * @property integer $productId
 * @property integer $amount
 * @property double $price
 * @property string $createdAt
 * @property string $updatedAt
 * @property string $deletedAt
 */
class OrderItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orderItem';
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
            [['orderId', 'productId', 'price'], 'required'],
            [['orderId', 'productId', 'amount'], 'integer'],
            [['price'], 'number'],
            [['createdAt', 'updatedAt', 'deletedAt'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'orderId' => Yii::t('app', 'Order ID'),
            'productId' => Yii::t('app', 'Product ID'),
            'amount' => Yii::t('app', 'Amount'),
            'price' => Yii::t('app', 'Price'),
            'createdAt' => Yii::t('app', 'Created At'),
            'updatedAt' => Yii::t('app', 'Updated At'),
            'deletedAt' => Yii::t('app', 'Deleted At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'productId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['id' => 'orderId']);
    }
}

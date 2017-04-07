<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "order".
 *
 * @property integer $id
 * @property integer $status
 * @property string $name
 * @property string $phone
 * @property string $email
 * @property string $address
 * @property double $fullPrice
 * @property double $discount
 * @property double $deliveryCost
 * @property double $taxCost
 * @property double $totalPrice
 * @property string $createdAt
 * @property string $updatedAt
 * @property string $deletedAt
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order';
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
            [['status'], 'integer'],
            [['fullPrice', 'discount', 'deliveryCost', 'taxCost', 'totalPrice'], 'default', 'value'=>0],
            [['fullPrice', 'discount', 'deliveryCost', 'taxCost', 'totalPrice'], 'number'],
            [['createdAt', 'updatedAt', 'deletedAt'], 'safe'],
            [['name', 'phone', 'email', 'address'], 'string', 'max' => 128],
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
            'phone' => Yii::t('app', 'Phone'),
            'email' => Yii::t('app', 'Email'),
            'address' => Yii::t('app', 'Address'),
            'fullPrice' => Yii::t('app', 'Full Price'),
            'discount' => Yii::t('app', 'Discount'),
            'deliveryCost' => Yii::t('app', 'Delivery Cost'),
            'taxCost' => Yii::t('app', 'Tax Cost'),
            'totalPrice' => Yii::t('app', 'Total Price'),
            'createdAt' => Yii::t('app', 'Created At'),
            'updatedAt' => Yii::t('app', 'Updated At'),
            'deletedAt' => Yii::t('app', 'Deleted At'),
        ];
    }
}

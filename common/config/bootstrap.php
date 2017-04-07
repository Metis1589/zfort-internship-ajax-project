<?php
Yii::setAlias('@common', dirname(__DIR__));
Yii::setAlias('@api', dirname(dirname(__DIR__)) . '/api');
Yii::setAlias('@techapi', dirname(dirname(__DIR__)) . '/techapi');
Yii::setAlias('@frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('@backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('@console', dirname(dirname(__DIR__)) . '/console');

Yii::$container->set('yii\behaviors\TimestampBehavior', [
    'createdAtAttribute' => 'createdAt',
    'updatedAtAttribute' => 'updatedAt',
    'value' => new \yii\db\Expression('now()'),
]);

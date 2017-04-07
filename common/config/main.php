<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=ash',
            'username' => '',
            'password' => '',
            'tablePrefix' => '',
            'charset' => 'utf8',
            'emulatePrepare' => true,
            'enableSchemaCache' => true,
            'schemaCacheDuration' => YII_DEBUG ? 30 : 86400,
            'queryCacheDuration' => YII_DEBUG ? 30 : 3600,
        ],
        'session' => [
            'class' => 'yii\web\Session',
            'cookieParams' => [
                'domain' => '.ash.com',
                'httpOnly' => true,
            ],
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
];

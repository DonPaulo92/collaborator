<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'errorHandler' => [
            'errorAction' => null,
        ],
        'cache' => [
            'class' => \yii\caching\FileCache::class,
        ],
    ],
];

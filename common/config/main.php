<?php
return [
    'name' => 'Raketos',
    'language' => 'ru',
    'sourceLanguage' => 'ru',
    'charset' => 'utf-8',
    'timezone' => 'UTC',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'controllerMap' => [
        'export' => 'phpnt\exportFile\controllers\ExportController'
    ],
    'components' => [
        'eauth' => require('eauth.php'),
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    //'basePath' => '@app/messages',
                    //'sourceLanguage' => 'en-US',
                    'fileMap' => [
                        'app' => 'app.php',
                        'app/error' => 'error.php',
                    ],
                ],
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    //'basePath' => '@app/messages',
                    //'sourceLanguage' => 'en-US',
                    'fileMap' => [
                        'app' => 'app.php',
                        'app/error' => 'error.php',
                    ],
                ],
            ],
        ],
    ],
];

<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'articles' => [
            'class' => 'backend\modules\articles\Module',
        ],
        'car' => [
            'class' => 'backend\modules\car\Module',
        ],
        /*'ckeditor' => [
            'class' => 'wadeshuler\ckeditor\Module',
        ],*/
        'ckeditor' => [
            'class' => 'wadeshuler\ckeditor\Module',    // required and dont change!!!

            //'controllerNamespace' => 'wadeshuler\ckeditor\controllers\default',    // to override my controller
            //'preset' => 'basic',    // default: basic - options: basic, standard, standard-all, full, full-all
            //'customCdn' => '//cdnjs.cloudflare.com/ajax/libs/ckeditor/4.5.10/ckeditor.js',    // must point to ckeditor.js

            'uploadDir' => '@frontend/web/uploads',    // must be file path (required when using filebrowser*BrowseUrl below)
            'uploadUrl' => 'http://car.raketos.ru/frontend/web/uploads',         // must be valid URL (required when using filebrowser*BrowseUrl below)

            // how to add external plugins (must also list them in `widgetClientOptions` `extraPlugins` below)
            //'widgetExternalPlugins' => [
            //    ['name' => 'pluginname', 'path' => '/path/to/', 'file' => 'plugin.js'],
            //    ['name' => 'pluginname2', 'path' => '/path/to2/', 'file' => 'plugin.js'],
            //],
            // passes html options to the text area tag itself. Mostly useless as CKEditor hides the <textarea> and uses it's own div
            /*'widgetOptions' => [
                'rows' => '300',
            ],*/

            // These are basically passed to the `CKEDITOR.replace()`
            'widgetClientOptions' => [
                //'skin' => 'moono',    // must be in skins directory
                //'skin' => 'kama,http://cdn.ckeditor.com/4.5.10/standard-all/skins/kama/'    // skin from somehwere else - http://docs.ckeditor.com/#!/api/CKEDITOR.config-cfg-skin
                //'extraPlugins' => 'abbr,inserthtml',     // list of externalPlugins (loaded from `widgetExternalPlugins` above)
                //'customConfig' => '@web/js/myconfig.js',
                //'filebrowserBrowseUrl' => '/ckeditor/default/file-browse',
                'height' => '600',
                'filebrowserUploadUrl' => '/ckeditor/default/file-upload',
                'filebrowserImageBrowseUrl' => '/ckeditor/default/image-browse',
                'filebrowserImageUploadUrl' => '/ckeditor/default/image-upload',
            ]
        ],
        'info' => [
            'class' => 'backend\modules\info\Module',
        ],
        'invoice' => [
            'class' => 'backend\modules\invoice\Module',
        ],
        'page' => [
            'class' => 'backend\modules\page\Module',
        ],
        'questions' => [
            'class' => 'backend\modules\questions\Module',
        ],
        'rbac' => [
            'class' => 'backend\modules\rbac\Module',
        ],
        'setting' => [
            'class' => 'backend\modules\setting\Module',
        ],
        'user' => [
            'class' => 'backend\modules\user\Module',
        ],
        'usercars' => [
            'class' => 'backend\modules\usercars\Module',
        ],
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'user' => [
            'identityClass' => \common\models\extend\UserExtend::className(),
            'enableAutoLogin' => true,
            'loginUrl' => ['/site/login'],
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                [
                    'pattern' => '',
                    'route' => 'site/index',
                ],
            ],
        ],
    ],
    'params' => $params,
];

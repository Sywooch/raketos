<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'geoData'],
    'controllerNamespace' => 'frontend\controllers',
    'controllerMap' => [
        'auth' => [
            'class'         => 'phpnt\oAuth\controllers\AuthController',
            'modelUser'     => 'common\models\extend\UserExtend'  // путь к модели User
        ],
        'images' => [
            'class'         => 'frontend\components\ImageProcessing\ImagesController',
        ],
    ],
    'modules' => [
        'car' => [
            'class' => 'frontend\modules\car\Module',
        ],
    ],
    'components' => [
        'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            'clients' => [
                'google' => [
                    // https://console.developers.google.com/project
                    'class' => 'phpnt\oAuth\oauth\Google',
                    'clientId' => '324148681845-hbd8ohbtlqutgktu9utj0a0221a0uodf.apps.googleusercontent.com',
                    'clientSecret' => 'D-ht8gZBq8VALPCajS7-bBRS',
                ],
                'yandex' => [
                    // https://oauth.yandex.ru/client/new
                    'class' => 'phpnt\oAuth\oauth\Yandex',
                    'clientId' => '64ff2128b51842c4875a4cd6c7560aa4',
                    'clientSecret' => '222c302b71024125b09596171cdfb19c',
                ],
                'facebook' => [
                    // https://developers.facebook.com/apps
                    'class'         => 'phpnt\oAuth\oauth\Facebook',
                    'clientId'      => '1679768568984069',
                    'clientSecret'  => 'c0897689128e28eb19fcf6639441bb40',
                ],
                'vkontakte' => [
                    // https://vk.com/editapp?act=create
                    'class'         => 'phpnt\oAuth\oauth\VKontakte',
                    'clientId'      => '6004534',
                    'clientSecret'  => 'l9ycQUJTPnlEqWNezreh',
                ],
                'twitter' => [
                    // https://dev.twitter.com/apps/new
                    'class' => 'phpnt\oAuth\oauth\Twitter',
                    'consumerKey' => 'QJ9IcgMDptjEB4tJEVi6dJhMu',
                    'consumerSecret' => 'ICp5qfGQ7tErOpYZnVrgXjczlihYnJ54xBlQAiLI0zhSiLFSww',
                ],
                /*'linkedin' => [
                    // https://www.linkedin.com/developer/apps/
                    'class' => 'phpnt\oAuth\oauth\LinkedIn',
                    'clientId' => '---',
                    'clientSecret' => '---',
                ],
                'github' => [
                    // https://github.com/settings/applications/new
                    'class' => 'phpnt\oAuth\oauth\GitHub',
                    'clientId' => '---',
                    'clientSecret' => '---',
                    'scope' => 'user:email, user'
                ],*/
            ]
        ],
        'geoData' => [
            'class'             => 'phpnt\geoData\GeoData',         // путь к классу
            'addToCookie'       => true,                            // сохранить в куки
            'addToSession'      => true,                            // сохранить в сессии
            'setTimezoneApp'    => true,                            // установить timezone в formatter (для вывода)
            'cookieDuration'    => 2592000                          // время хранения в куки
        ],
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'user' => [
            'identityClass' => \common\models\extend\UserExtend::className(),
            'enableAutoLogin' => true,
            'ReturnUrl' => ['/profile'],
            'loginUrl' => ['/site/login'],
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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
            //'class' => \common\components\CityUrl::className(),
            'class' => \common\components\MyUrlManager::className(),
            'city' => '524901',
            'frontendUrl' => 'http://raketos.loc',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                [
                    'pattern' => '',
                    'route' => 'site/index',
                ],
            ],
        ],
        'yakassa' => [
            'class' => \common\widgets\YaKassa\YaKassa::className(),
            'paymentAction' => 'https://demomoney.yandex.ru/eshop.xml',
            'shopPassword' => 'vD2lz45e',
            'securityType' => 'MD5',
            'shopId' => '132979',
            'scId' => '553250',
            'currency' => '10643'
        ],
    ],
    'params' => $params,
];

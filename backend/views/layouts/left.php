<?php
/**
 * Created by PhpStorm.
 * User: Raketos - http://raketos.ru
 * Date: 01.12.2016
 * Time: 22:34
 */
use yii\helpers\Url;
use yii\bootstrap\NavBar;
use yii\widgets\Menu;
use yii\bootstrap\Html;

/* @var $user \common\models\Identity */
?>
<?php
NavBar::begin([
    'brandLabel' => false,
    'brandUrl' => false,
    'options' => [
        'class' => 'navbar-default navbar-static-side',
    ],
    'containerOptions' => [
        'class' => 'sidebar-collapse'
    ],
    'innerContainerOptions' => [
        'class' => 'sidebar-collapse'
    ],
    'renderInnerContainer' => false
]);
$i = 1;
foreach($user->imagesMain as $one):
    /* @var $one \phpnt\cropper\models\Photo */
    if($i == 1) {
        $image = Html::img(\Yii::$app->params['frontendUrl'].'/'.$one->file_small,
            [
                'width' => '100px',
                'style' => 'margin: 1px;',
                'class' => 'img-circle'
            ]);
    } else {
        break;
    }
    $i++;
endforeach;
if(!isset($image)){
    $image = Html::img('/images/no-avatar.png',
        [
            'width' => '100px',
            'style' => 'margin: 1px;',
            'class' => 'img-circle'
        ]);
}

$items[] =
    [
        'label' => '<span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">'.$user->email.'</strong>
                             </span> <span class="text-muted text-xs block">'.$user->getRoleDescription().' <b class="caret"></b></span> </span>
                            ',
        'url'   => '#',
        'linkOptions' => [
            'class' => 'dropdown-toggle'
        ],
        'options' => [
            'class' => 'nav-header'
        ],
        'template' => '<div class="dropdown profile-element"> <span>'.$image.'</span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">{label}</a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a href="/#">Что-то</a></li>
                            <li class="divider"></li>
                            <li><a href="/site/logout">Выйти</a></li>
                        </ul>
                    </div>
                    <div class="logo-element">CAR</div>',
    ];

if (Yii::$app->user->can('admin')) {
    $items[] = [
        'label' => '<i class="fa fa-pie-chart"></i> <span class="nav-label">' . Yii::t('app', 'Главная') . '</span>',
        'url' => Url::to(['/site/index']),
        'options' => [
            'class' => (Yii::$app->controller->id == 'site' && Yii::$app->controller->action->id == 'index') ? 'active' : ''
        ],
    ];
}

if (Yii::$app->user->can('admin')) {
    $items[] =  [
        'label' => '<i class="fa fa-users"></i> <span class="nav-label">' . Yii::t('app', 'Пользователи') . '</span><span class="fa arrow"></span>',
        'url'   => '#',
        'submenuTemplate' => '<ul class="nav nav-second-level collapse">{items}</ul>',
        'options'=>[
            'class'=> (Yii::$app->controller->module->id == 'user') ? 'active' : ''
        ],
        'items' => [
            [
                'label' => Yii::t('app', 'Пользователи'),
                'url'   => Url::to(['/user/manage']),
                'options' => [
                    'class'=> (Yii::$app->controller->module->id == 'user') ? 'active' : ''
                ],
            ],
            /*[
                'label' => Yii::t('app', 'Роли пользователей'),
                'url' => Url::to(['/user/auth-assignment']),
                'options'   => ['class' => (Yii::$app->controller->module->id == 'car' && Yii::$app->controller->id == 'auth-assignment') ? 'active' : '']
            ],*/
        ],
    ];
}

if (Yii::$app->user->can('admin')) {
    $items[] = [
        'label' => '<i class="fa fa-circle"></i> <span class="nav-label">' . Yii::t('app', 'Объявления') . '</span>',
        'url'   => Url::to(['/usercars/manage']),
        'options' => [
            'class'=> (Yii::$app->controller->module->id == 'usercars') ? 'active' : ''
        ],
    ];
}

if (Yii::$app->user->can('admin')) {
    $items[] = [
        'label' => '<i class="fa fa-pie-chart"></i> <span class="nav-label">' . Yii::t('app', 'Счета') . '</span>',
        'url' => Url::to(['/invoice/manage/index']),
        'options' => [
            'class' => (Yii::$app->controller->module->id == 'invoice') ? 'active' : ''
        ],
    ];
}

if (Yii::$app->user->can('admin')) {
    $items[] = [
        'label' => '<i class="fa fa-question-circle"></i> <span class="nav-label">Вопрос - Ответ</span>',
        'url'   => Url::to(['/questions/manage']),
        'options' => [
            'class'=> (Yii::$app->controller->module->id == 'questions') ? 'active' : ''
        ],
    ];
}

if (Yii::$app->user->can('admin')) {
    $items[] = [
        'label' => '<i class="fa fa-info-circle"></i> <span class="nav-label">Пол. информация</span>',
        'url'   => Url::to(['/info/manage']),
        'options' => [
            'class'=> (Yii::$app->controller->module->id == 'info') ? 'active' : ''
        ],
    ];
}

if (Yii::$app->user->can('admin')) {
    $items[] = [
        'label' => '<i class="fa fa-file-text"></i> <span class="nav-label">Статьи</span>',
        'url'   => Url::to(['/articles/manage']),
        'options' => [
            'class'=> (Yii::$app->controller->module->id == 'articles') ? 'active' : ''
        ],
    ];
}

if (Yii::$app->user->can('admin')) {
    $items[] =  [
        'label' => '<i class="fa fa-car"></i> <span><span class="nav-label">Управление авто</span><span class="fa arrow"></span>',
        'url'   => '#',
        'submenuTemplate' => '<ul class="nav nav-second-level collapse">{items}</ul>',
        'options'=>[
            'class'=> (Yii::$app->controller->module->id == 'car') ? 'active' : ''
        ],
        'items' => [
            [
                'label' => Yii::t('app', 'Марки'),
                'url' => Url::to(['/car/mark']),
                'options'   => ['class' => (Yii::$app->controller->module->id == 'car' && Yii::$app->controller->id == 'mark') ? 'active' : '']
            ],
            [
                'label' => Yii::t('app', 'Модели'),
                'url' => Url::to(['/car/model']),
                'options'   => ['class' => (Yii::$app->controller->module->id == 'car' && Yii::$app->controller->id == 'model') ? 'active' : '']
            ],
            /*[
                'label' => Yii::t('app', 'Характеристики'),
                'url' => Url::to(['/car/specification']),
                'options'   => ['class' => (Yii::$app->controller->module->id == 'car' && Yii::$app->controller->id == 'specification') ? 'active' : '']
            ],*/
        ],
    ];
}

if (Yii::$app->user->can('admin')) {
    $items[] =  [
        'label' => '<i class="fa fa-newspaper-o"></i><span class="nav-label">'.Yii::t('app', 'Страницы сайта').'</span><span class="fa arrow"></span>',
        'url'   => '#',
        'submenuTemplate' => '<ul class="nav nav-second-level collapse">{items}</ul>',
        'options'=>[
            'class'=> (Yii::$app->controller->module->id == 'page') ? 'active' : ''
        ],
        'items' => [
            [
                'label' => Yii::t('app', 'Вопрос-Ответ'),
                'url' => Url::to(['/page/questions']),
                'options'   => ['class' => (Yii::$app->controller->id == 'questions') ? 'active' : '']
            ],
            [
                'label' => Yii::t('app', 'Пол. информация'),
                'url' => Url::to(['/page/info']),
                'options'   => ['class' => (Yii::$app->controller->module->id == 'page' && Yii::$app->controller->id == 'info') ? 'active' : '']
            ],
            [
                'label' => Yii::t('app', 'Статьи'),
                'url' => Url::to(['/page/articles']),
                'options'   => ['class' => (Yii::$app->controller->module->id == 'page' && Yii::$app->controller->id == 'articles') ? 'active' : '']
            ],
            [
                'label' => Yii::t('app', 'О проекте'),
                'url' => Url::to(['/page/about']),
                'options'   => ['class' => (Yii::$app->controller->module->id == 'page' && Yii::$app->controller->id == 'about') ? 'active' : '']
            ],
        ],
    ];
}

if (Yii::$app->user->can('admin')) {
    $items[] =  [
        'label' => '<i class="fa fa-file"></i> <span class="nav-label">' . Yii::t('app', 'Экспорт в CSV') . '</span>',
        'url'   => '/export-csv',
        'options'=>[
            'class'=> (Yii::$app->controller->id == 'export-csv') ? 'active' : ''
        ],
    ];
}

if (Yii::$app->user->can('admin')) {
    $items[] =  [
        'label' => '<i class="fa fa-gears"></i> <span><span class="nav-label">'.Yii::t('app', 'Настройки').'</span><span class="fa arrow"></span>',
        'url'   => '#',
        'submenuTemplate' => '<ul class="nav nav-second-level collapse">{items}</ul>',
        'options'=>[
            'class'=> (Yii::$app->controller->module->id == 'setting' || Yii::$app->controller->module->id == 'content' || Yii::$app->controller->module->id == 'rbac') ? 'active' : ''
        ],
        'items' => [
            /*[
                'label' => Yii::t('app', 'Контент'),
                'url' => Url::to(['/#']),
                'options'   => ['class' => (Yii::$app->controller->module->id == 'translate' && Yii::$app->controller->id == 'manage') ? 'active' : '']
            ],*/
            [
                'label' => Yii::t('app', 'Тарифы'),
                'url' => Url::to(['/setting/ads-tariff']),
                'options'   => ['class' => (Yii::$app->controller->module->id == 'setting' && Yii::$app->controller->id == 'ads-tariff') ? 'active' : '']
            ],
            [
                'label' => Yii::t('app', 'Расчет рейтинга'),
                'url' => Url::to(['/setting/calculate']),
                'options'   => ['class' => (Yii::$app->controller->module->id == 'setting' && Yii::$app->controller->id == 'calculate') ? 'active' : '']
            ],
            [
                'label' => Yii::t('app', 'Главный фильтр'),
                'url' => Url::to(['/setting/main-filter']),
                'options'   => ['class' => (Yii::$app->controller->module->id == 'setting' && Yii::$app->controller->id == 'main-filter') ? 'active' : '']
            ],
            [
                'label' => Yii::t('app', 'Роли и разрешения'),
                'url' => Url::to(['/rbac/manage/index']),
                'options'   => ['class' => (Yii::$app->controller->module->id == 'rbac' && Yii::$app->controller->id == 'manage') ? 'active' : '']
            ],
            [
                'label' => Yii::t('app', 'Yii2 Logger'),
                'url' => Url::to(['/setting/info/logger']),
                'options'   => ['class' => (Yii::$app->controller->id == 'info' && Yii::$app->controller->action->id == 'logger') ? 'active' : '']
            ],
            [
                'label' => Yii::t('app', 'PHP Info'),
                'url' => Url::to(['/setting/info/phpinfo']),
                'options'   => ['class' => (Yii::$app->controller->id == 'info' && Yii::$app->controller->action->id == 'phpinfo') ? 'active' : '']
            ],
        ],
    ];
}

echo Menu::widget(
    [
        'options' => [
            'id'    => 'side-menu',
            'class' => 'nav metismenu',
        ],
        'encodeLabels' => false,
        'items' => $items
    ]
) ?>
<?php
NavBar::end();
?>

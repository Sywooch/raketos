<?php
/**
 * Created by PhpStorm.
 * User: Raketos - http://raketos.ru
 * Date: 09.09.2016
 * Time: 12:58
 */

/* @var $this \yii\web\View */
/* @var $content string */
/* @var $user \common\models\User */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use frontend\assets\AppAsset;
use common\widgets\Pace\PaceAsset;
use phpnt\bootstrapNotify\BootstrapNotify;
use common\widgets\AuthWidget\AuthWidget;
use common\widgets\SelectCity\SelectCity;
use frontend\assets\MainMenuAsset;
use frontend\assets\SecondMenuAsset;
use yii\helpers\Url;

AppAsset::register($this);
PaceAsset::register($this);
$user = Yii::$app->user->identity;

if (Yii::$app->controller->id == 'site' && Yii::$app->controller->action->id == 'index') {
    MainMenuAsset::register($this);
} else {
    SecondMenuAsset::register($this);
}
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <style><?= (Yii::$app->controller->id == 'site' && Yii::$app->controller->action->id == 'index') ? '' : 'body {background-color: #2f4050 !important;}' ?></style>
</head>
<body id="page-top" class="<?= 'landing-page' ?> pace-done" style="background-color: #212121 !important;">
<?php $this->beginBody() ?>
<?php
if (Yii::$app->controller->id == 'site' && Yii::$app->controller->action->id == 'index') {
    $navBarClass = 'navbar navbar-default navbar-fixed-top navbar-index navbar-offset-top';
    $hidden = 'hidden';
} else {
    $navBarClass = 'navbar navbar-default navbar-fixed-top navbar-index navbar-offset-top navbar-scroll';
    $hidden = '';
}
?>


<div class="top-header-navbar text-center <?= $hidden ?>">
    <div class="container" style="width: 90%">
        <div style="row">
            <div class="hidden"> <a href="#"><i class="fa fa-vk"></i></a> <a href="#"><i class="fa fa-twitter"></i></a> <a href="#"><i class="fa fa-facebook"></i></a> </div>
            <div class="hidden"> <address>
                    <i class="fa fa-envelope-o" aria-hidden="true"></i>&nbsp;kapitan@raketos.ru&nbsp;
                    <!-- <i class="fa fa-mobile" aria-hidden="true"></i>&nbsp;8&nbsp;800&nbsp;2000&nbsp;600-->
                </address> </div>
            <div class="col-md-4 col-sm-4 col-xs-4 hidden-xs"><?= SelectCity::widget() ?></div>
            <div class="col-md-3 col-sm-7 col-xs-8"><?= AuthWidget::widget() ?></div>
        </div>
    </div>
</div>
<div class="clearfix"></div>
<div class="navbar-wrapper <?= $hidden ?>">
    <?php
    NavBar::begin([
        'brandLabel' => Html::img(['/../img/logo-main.png'], ['class' => 'logo-image', 'style' => 'width: 120px;']),
        'brandUrl' => Yii::$app->homeUrl,
        'brandOptions' => [
            'class' => 'page-scroll',
        ],
        'containerOptions' => [
            'id' => 'navbar',
            'class' => 'navbar-collapse collapse'
        ],
        'options' => [
            'id' => 'main-menu',
            'class' => $navBarClass,
            'style' => 'padding-right: 60px;'
        ],
    ]);

    $menuItems[] = ['label' => Yii::t('app', 'ГЛАВНАЯ'), 'url' => ['/site/index']];
    $menuItems[] = ['label' => Yii::t('app', 'ПОИСК'), 'url' => ['/users-car/search']];
    $menuItems[] = ['label' => Yii::t('app', 'TOP-100'), 'url' => ['/site/top', 'sort' => '-rating']];
    $menuItems[] = ['label' => Yii::t('app', 'ОБЪЯВЛЕНИЯ'), 'url' => ['/users-car/index']];
    $menuItems[] = [
        'label' => 'ЕЩЕ',
        'options' => [
            'class' => (Yii::$app->controller->id == 'site' &&
                (
                    Yii::$app->controller->action->id == 'questions' ||
                    Yii::$app->controller->id == 'info' ||
                    Yii::$app->controller->id == 'articles' ||
                    Yii::$app->controller->id == 'about')) ? 'active' : '',
            'style' => '/*overflow: auto*/'
        ],
        'items' => [
            [
                'label' => Yii::t('app', 'ВОПРОСЫ-ОТВЕТЫ'),
                'url' => ['/questions'],
                'options' => ['class' => (Yii::$app->controller->id == 'site' && Yii::$app->controller->action->id == 'questions') ? 'active' : ''],
            ],
            [
                'label' => 'ПОЛЕЗНАЯ ИНФОРМАЦИЯ',
                'url' => '/info',
                'options' => ['class' => (Yii::$app->controller->id == 'site' && Yii::$app->controller->action->id == 'info') ? 'active' : ''],
            ],
            [
                'label' => 'СТАТЬИ',
                'url' => '/articles',
                'options' => ['class' => (Yii::$app->controller->id == 'site' && Yii::$app->controller->action->id == 'articles') ? 'active' : ''],
            ],
            [
                'label' => 'О ПРОЕКТЕ',
                'url' => '/site/about',
                'options' => ['class' => (Yii::$app->controller->id == 'site' && Yii::$app->controller->action->id == 'about') ? 'active' : ''],
            ],
            /*'<li class="divider"></li>',
            '<li class="dropdown-header">Dropdown Header</li>',*/
        ]];
    //$menuItems[] = ['label' => Yii::t('app', 'Добавить объявление'), 'url' => ['/#'], 'linkOptions' => ['class' => 'btn btn-primary']];

    echo Nav::widget([
        'id' => 'navbar',
        'options' => ['class' => 'nav navbar-nav'],
        'items' => $menuItems,
        'encodeLabels' => false
    ]);

    echo '<div class="add-ads" style="width: 100%;">'.Html::a('Добавить объявление', ['/car/feed'], ['class' => 'btn btn-primary']).'</div>';

    NavBar::end();
    ?>
</div>

<?php
if ((Yii::$app->controller->id == 'site' && Yii::$app->controller->action->id == 'index') /*|| Yii::$app->controller->action->id == 'view'*/):
    ?>
    <?= $content ?>
    <?php
endif;
?>
<?php
if ((Yii::$app->controller->id != 'site' || Yii::$app->controller->action->id != 'index') /*&& Yii::$app->controller->action->id != 'view'*/):
?>
<div class="">
    <div class="gray-bg">
        <?= BootstrapNotify::widget(); ?>

            <div class="container" style="margin-top: 80px;">
                <div class="col-md-12" style="/*margin-bottom: 60px;*/">
                    <?= $content ?>
                </div>
            </div>

    </div>
</div>
    <?php
endif;
?>
<div class="clearfix"></div>
<footer class="footer" style="position: relative; padding-top: 80px;">
    <!--    <aside class="footer-navbar">
  <div class="container">
    <div class="row">
      <div class="col-md-12"></div>
    </div>
  </div>
</aside>-->
    <article class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-3">
                    <section> <img src="/img/logo-footer.png" alt="..." class="img-responsive">
                        <!--<br>
                        <br> Просеивание, несмотря на внешние воздействия, дает промывной бюкс. Денситомер переносит аллювий. Фингер-эффект растягивает пахотный дренаж, хотя этот факт нуждается в дальнейшей тщательной экспериментальной проверке.
                        <br>--> </section>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-3">
                    <section>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <header> Наши&nbsp;партнеры </header>
                        </div>
                        <div class="col-xs-6 col-sm-3 col-md-6">
                            <div class="footer-partner-1"><img src="/img/footer-partner-1.png" alt="..." class="img-responsive center-block img-rounded"></div>
                        </div>
                        <div class="col-xs-6 col-sm-3 col-md-6">
                            <div class="footer-partner-2"><img src="/img/footer-partner-2.png" alt="..." class="img-responsive center-block img-rounded"></div>
                        </div>
                        <div class="col-xs-6 col-sm-3 col-md-6">
                            <div class="footer-partner-3"><img src="/img/footer-partner-3.png" alt="..." class="img-responsive center-block img-rounded"></div>
                        </div>
                        <div class="col-xs-6 col-sm-3 col-md-6">
                            <div class="footer-partner-4"><img src="/img/footer-partner-4.png" alt="..." class="img-responsive center-block img-rounded"></div>
                        </div>
                    </section>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-3">
                    <section>
                        <header> Свяжитесь&nbsp;с&nbsp;нами </header>
						
                      
                          <!-- <br> <i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;Архангельск-->
                           <!--   <br> <i class="fa fa-mobile" aria-hidden="true"></i>&nbsp;8&nbsp;800&nbsp;2000&nbsp;600-->
                        По вопросам сотрудничества пишите:<br> <i class="fa fa-envelope-o" aria-hidden="true"></i>&nbsp;kapitan@raketos.ru
                         </section>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-3">
                    <section>
                        <header> Прочая&nbsp;информация </header>
                        Все объявления на сайте raketos.ru размещены посетителями сайта. 
                        Админстрация сайта за достоверность объявлений ответственности не несет.
                        <br> </section>
                </div>
            </div>
        </div>
    </article>
    <article class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <section class="raketos-copyright pull-left"> ©Raketos. Все права защищены. </section>
                </div>
                <section>
                    <div class="col-md-7">
                        <nav class="footer-menu pull-right hidden-xs">
                            <ul class="nav nav-pills">
                                <li> <a href="<?= Url::to(['/site/index']) ?>">ГЛАВНАЯ</a> </li>
                                <li> <a href="<?= Url::to(['/users-car/search']) ?>">ПОИСК</a> </li>
                                <li> <a href="<?= Url::to(['/site/top', 'sort' => '-rating']) ?>">ТОП-100</a> </li>
                                <li> <a href="<?= Url::to(['/questions']) ?>">ВОПРОСЫ-ОТВЕТЫ</a> </li>
                                <li> <a href="<?= Url::to(['/users-car/index']) ?>">ОБЪЯВЛЕНИЯ</a> </li>
                            </ul>
                        </nav>
                    </div>
                </section>
            </div>
        </div>
    </article>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

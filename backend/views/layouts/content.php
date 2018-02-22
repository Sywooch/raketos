<?php
/**
 * Created by PhpStorm.
 * User: Raketos - http://raketos.ru
 * Date: 01.12.2016
 * Time: 22:35
 */
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
use yii\bootstrap\Html;
?>
<div id="page-wrapper" class="gray-bg" style="min-height: 798px;">
    <?= $this->render('header',
        [
            'user'          => $user,
            'username'      => $username,
            'avatar'        => $avatar
        ]); ?>

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2><?= Html::encode($this->title) ?></h2>
            <?= Breadcrumbs::widget([
                'homeLink' => ['label' => Yii::t('app', 'Главная'), 'url' => Url::to(['/'])],
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : ['label' => ''],
            ]) ?>
        </div>
        <div class="col-lg-2">

        </div>
    </div>


    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <?= $content ?>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="footer">
        <div class="pull-right">
            <strong>Все права защищены</strong> © <?= date('Y') ?>.
        </div>
        <div>

        </div>
    </div>

</div>

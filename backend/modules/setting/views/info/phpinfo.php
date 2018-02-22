<?php
/**
 * Created by PhpStorm.
 * User: Raketos - http://raketos.ru
 * Date: 16.04.2017
 * Time: 12:16
 */

use yii\helpers\Url;
use yii\bootstrap\Html;

/* @var $this \yii\web\View */
?>
<div class="clearfix"></div>
<div style="text-align: center">
    <?= Html::a('Назад', Url::home()) ?>
    <?= phpinfo() ?>
    <?= Html::a('Назад', Url::home()) ?>
</div>
<div class="clearfix"></div>
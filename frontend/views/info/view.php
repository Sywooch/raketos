<?php
/**
 * Created by PhpStorm.
 * User: Raketos - http://raketos.ru
 * Date: 14.06.2016
 * Time: 1:34
 */
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $model \common\models\extend\InfoExtend */

$this->title = $model->name;
?>
<div class="col-md-12" style="margin-top: 80px;">
<div class="container" style="background-color: #ffffff;">
    <div class="col-md-12" style="margin-top: 60px;">
        <?= Html::a('<i class="fa fa-arrow-left" aria-hidden="true"></i> Назад', Url::to(['/info/index']), ['class' => 'btn btn-primary']) ?>
    </div>
    <div class="col-md-12">
        <h1><?= $this->title ?></h1>
    </div>
    <div class="col-md-12">
        <?= $model->text ?>
    </div>
    <div class="col-md-12" style="margin-bottom: 60px;">
        <?= Html::a('<i class="fa fa-arrow-left" aria-hidden="true"></i> Назад', Url::to(['/info/index']), ['class' => 'btn btn-primary']) ?>
    </div>
</div>
</div>
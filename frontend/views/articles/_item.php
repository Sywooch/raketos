<?php
/**
 * Created by PhpStorm.
 * User: Raketos - http://raketos.ru
 * Date: 16.06.2016
 * Time: 18:54
 */

use yii\bootstrap\Html;
use yii\helpers\Url;

/* @var $model \common\models\extend\ArticleExtend */
?>
<div class="row">
    <div class="col-md-12">
        <h2><?= $model->name ?></h2>
        <h3 style="text-align: justify;"><?= $model->short_desc ?></h3>
    </div>
    <div class="col-xs-6 text-left">
        <?= Html::a('Читать', Url::to(['/articles/view', 'id' => $model->id]), ['class' => 'btn btn-primary']) ?>
    </div>
    <div class="col-xs-6 text-right">
        <?= Yii::$app->formatter->asDate($model->created_at) ?>
    </div>
    <div class="clearfix"></div>
    <div class="navy-line" style="padding-top: 0; margin-top: 10px;"></div>
</div>

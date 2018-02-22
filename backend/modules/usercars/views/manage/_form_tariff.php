<?php
/**
 * Created by PhpStorm.
 * User: Raketos - http://raketos.ru
 * Date: 04.04.2017
 * Time: 10:21
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use phpnt\bootstrapSelect\BootstrapSelectAsset;

/* @var $this yii\web\View */
/* @var $model common\models\forms\AdsForm */
/* @var $form yii\widgets\ActiveForm */

BootstrapSelectAsset::register($this);
?>

<div class="user-form-form">

    <?php $form = ActiveForm::begin([
        'action' => Url::to(['set-tariff', 'id' => $model->id]),
        'options' => ['data-pjax' => true],
    ]); ?>

    <?= $form->field($model, 'tariff_id')->dropDownList($model->tariffList, [
        'class'     => 'form-control selectpicker',
        //'disabled'  => true,
        'data' => [
            'style' => 'btn-primary',
            //'live-search' => 'true',
            //'size' => 10,
            'title' => $model->getAttributeLabel('tariff_id')
        ]
    ]); ?>

    <div class="clearfix"></div>

    <div class="form-group text-center" style="margin-top: 30px;">
        <?= Html::submitButton('Назначить тариф', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

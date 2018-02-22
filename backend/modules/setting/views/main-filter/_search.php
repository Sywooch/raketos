<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\search\MainFilterSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="main-filter-form-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'body') ?>

    <?= $form->field($model, 'number_of_seats') ?>

    <?= $form->field($model, 'length') ?>

    <?php // echo $form->field($model, 'trunk_volume_max') ?>

    <?php // echo $form->field($model, 'engine_capacity') ?>

    <?php // echo $form->field($model, 'drive_unit') ?>

    <?php // echo $form->field($model, 'ground_clearance') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

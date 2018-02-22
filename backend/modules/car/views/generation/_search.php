<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\search\CarGenerationSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="car-generation-form-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_car_generation') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'id_car_model') ?>

    <?= $form->field($model, 'year_begin') ?>

    <?= $form->field($model, 'year_end') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

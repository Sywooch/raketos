<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\search\AdsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ads-form-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_car_mark') ?>

    <?= $form->field($model, 'id_car_model') ?>

    <?= $form->field($model, 'id_car_generation') ?>

    <?= $form->field($model, 'id_car_serie') ?>

    <?php // echo $form->field($model, 'id_car_modification') ?>

    <?php // echo $form->field($model, 'mileage') ?>

    <?php // echo $form->field($model, 'power_ptc') ?>

    <?php // echo $form->field($model, 'mileage_rus') ?>

    <?php // echo $form->field($model, 'doc') ?>

    <?php // echo $form->field($model, 'broken') ?>

    <?php // echo $form->field($model, 'work') ?>

    <?php // echo $form->field($model, 'vin') ?>

    <?php // echo $form->field($model, 'num_reg') ?>

    <?php // echo $form->field($model, 'desc') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'exchange') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'city_id') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'image_main') ?>

    <?php // echo $form->field($model, 'images') ?>

    <?php // echo $form->field($model, 'temp') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

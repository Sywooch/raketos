<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\forms\AdsForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ads-form-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_car_mark')->textInput() ?>

    <?= $form->field($model, 'id_car_model')->textInput() ?>

    <?= $form->field($model, 'id_car_generation')->textInput() ?>

    <?= $form->field($model, 'id_car_serie')->textInput() ?>

    <?= $form->field($model, 'id_car_modification')->textInput() ?>

    <?= $form->field($model, 'mileage')->textInput() ?>

    <?= $form->field($model, 'power_ptc')->textInput() ?>

    <?= $form->field($model, 'mileage_rus')->textInput() ?>

    <?= $form->field($model, 'doc')->textInput() ?>

    <?= $form->field($model, 'broken')->textInput() ?>

    <?= $form->field($model, 'work')->textInput() ?>

    <?= $form->field($model, 'vin')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'num_reg')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'desc')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'exchange')->textInput() ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'image_main')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'images')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'temp')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

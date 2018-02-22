<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\forms\CarMarkForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="car-make-form-form">

    <?php $form = ActiveForm::begin([
        'action' => ($model->isNewRecord) ? Url::to(['create']) : Url::to(['update', 'id' => $model->id_car_mark]),
        'options' => ['data-pjax' => true],
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div class="form-group text-center">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Изменить', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

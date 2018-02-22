<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\forms\CarSpecificationForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="car-specification-form-form">

    <?php $form = ActiveForm::begin([
        'action' => ($model->isNewRecord) ? Url::to(['create']) : Url::to(['update', 'id' => $model->id_car_specification]),
        'options' => ['data-pjax' => true],
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?/*= $form->field($model, 'id_parent')->textInput() */?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Изменить', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

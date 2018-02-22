<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\forms\AdsTariffForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ads-tariff-form-form">

    <?php $form = ActiveForm::begin([
        'action' => ($model->isNewRecord) ? Url::to(['create']) : Url::to(['update', 'id' => $model->id]),
        'options' => ['data-pjax' => true],
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'period')->textInput() ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <div class="form-group text-center">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Изменить', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

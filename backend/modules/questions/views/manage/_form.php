<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\forms\QuestionForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="question-form-form">

    <?php $form = ActiveForm::begin(['action' => ($model->isNewRecord) ? Url::to(['create']) : Url::to(['update', 'id' => $model->id]),
        'options' => ['data-pjax' => true]]); ?>

    <?= $form->field($model, 'question')->textInput(['maxlength' => true, 'disabled' => true]) ?>

    <?= $form->field($model, 'answer')->textarea(['placeholder' => $model->getAttributeLabel('answer'), 'style' => 'resize: vertical;']) ?>

    <div class="form-group text-center">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Ответить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

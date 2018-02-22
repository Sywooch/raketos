<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wadeshuler\ckeditor\widgets\CKEditor;

/* @var $this yii\web\View */
/* @var $model common\models\forms\DocumentForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="document-form-form" style="">

    <?php $form = ActiveForm::begin(); ?>
    <div class="col-md-12">
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-md-12">
    <?= $form->field($model, 'meta_keys')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-md-12">
    <?= $form->field($model, 'meta_desc')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-md-12">
    <?= $form->field($model, 'text', [])->widget(CKEditor::className()) ?>
    </div>

    <div class="form-group text-center">
        <?= Html::submitButton('Изменить', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use wadeshuler\ckeditor\widgets\CKEditor;

/* @var $this yii\web\View */
/* @var $model common\models\forms\ArticleForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-form-form">

    <?php $form = ActiveForm::begin([
        'action' => ($model->isNewRecord) ? Url::to(['create']) : Url::to(['update', 'id' => $model->id]),
        'options' => ['data-pjax' => true],
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'short_desc')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'meta_keys')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'meta_desc')->textInput(['maxlength' => true]) ?>

    <div class="col-md-12">
        <?= $form->field($model, 'text', [])->widget(CKEditor::className(), [
                'options' => ['id' => 'editor-'.$key]
        ]) ?>
    </div>

    <div class="form-group text-center">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Изменить', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

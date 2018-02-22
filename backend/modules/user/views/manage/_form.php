<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model common\models\forms\UserForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form-form">

    <?php $form = ActiveForm::begin([
        'action' => ($model->isNewRecord) ? Url::to(['create']) : Url::to(['update', 'id' => $model->id]),
        'options' => ['data-pjax' => true],
    ]); ?>

    <div class="col-md-4">
    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-md-4">
        <?php
        if (isset($model->phone)) {
            $model->input_phone = $model->getPhoneWithoutCode();
        }
        ?>
        <?= $form->field($model, 'input_phone', ['template' => '{label} 
                                            <div class="input-group">
                                                <span class="input-group-addon">+7</span>{input}
                                             </div>
                                            <i>{hint}</i>{error}'])
            ->widget(MaskedInput::className(),[
                'options' => [
                    'class' => 'form-control',
                    'id'    => 'mask',
                ],
                'name' => 'input_phone',
                'mask' => '(999) 999-99-99']) ?>
    </div>
    <div class="col-md-12 text-left">
                          
                 <div class="checkbox">
                         <?= $form->field($model, 'addprofiles')->checkbox(); ?>
<!--                        <label for="checkbox1">
                            Default
                        </label>-->
                    </div>
    </div>
    <div class="col-md-4">
    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-md-4">
    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-md-4">
    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-md-4">
    <?= $form->field($model, 'middle_name')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-md-4">
    <?= $form->field($model, 'balance')->textInput() ?>
    </div>

    <div class="clearfix"></div>

    <div class="form-group text-center" style="margin-top: 30px;">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Изменить', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

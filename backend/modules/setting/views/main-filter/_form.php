<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\forms\MainFilterForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="main-filter-form-form">

    <?php $form = ActiveForm::begin([
        'action' => ($model->isNewRecord) ? Url::to(['create']) : Url::to(['update', 'id' => $model->id]),
        'options' => ['data-pjax' => true],]); ?>
    <div class="col-md-12">
        <?= $form->field($model, 'body')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-2">
        <?= $form->field($model, 'number_of_seats')->textInput() ?>
    </div>
    <div class="col-md-2">
        <?= $form->field($model, 'width')->textInput() ?>
    </div>
    <div class="col-md-2">
        <?= $form->field($model, 'length')->textInput() ?>
    </div>
    <div class="col-md-2">
        <?= $form->field($model, 'height')->textInput() ?>
    </div>
    <div class="col-md-2">
        <?= $form->field($model, 'wheelbase')->textInput() ?>
    </div>
    <div class="col-md-2">
        <?= $form->field($model, 'track_front')->textInput() ?>
    </div>

    <div class="clearfix"></div>

    <div class="col-md-2">
        <?= $form->field($model, 'trunk_volume_min')->textInput()->label('Объем багажника MIN') ?>
    </div>
    <div class="col-md-2">
        <?= $form->field($model, 'trunk_volume_max')->textInput()->label('Объем багажника MAX') ?>
    </div>
    <div class="col-md-2">
        <?= $form->field($model, 'rear_track')->textInput() ?>
    </div>
    <div class="col-md-2">
        <?= $form->field($model, 'ground_clearance')->textInput()->label('Клиренс') ?>
    </div>
    <div class="col-md-2">
        <?= $form->field($model, 'engine_type')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-2">
        <?= $form->field($model, 'engine_capacity')->textInput() ?>
    </div>

    <div class="clearfix"></div>

    <div class="col-md-3">
        <?= $form->field($model, 'engine_power')->textInput() ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'turnover_of_max_power')->textInput(['maxlength' => true])->label('Обороты MAX мощности (об/мин)') ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'max_torque')->textInput()->label('MAX крутящий момент (Н*м)') ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'inlet_type')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="clearfix"></div>

    <div class="col-md-2">
        <?= $form->field($model, 'cylinder_arrangement')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-2">
        <?= $form->field($model, 'number_of_cylinders')->textInput() ?>
    </div>
    <div class="col-md-2">
        <?= $form->field($model, 'cylinder_diameter')->textInput() ?>
    </div>
    <div class="col-md-2">
        <?= $form->field($model, 'number_of_valves_per_cylinder')->textInput() ?>
    </div>
    <div class="col-md-2">
        <?= $form->field($model, 'ground_clearance')->textInput() ?>
    </div>
    <div class="col-md-2">
        <?= $form->field($model, 'fuel_tank_capacity')->textInput() ?>
    </div>

    <div class="clearfix"></div>

    <div class="col-md-2">
        <?= $form->field($model, 'piston_stroke')->textInput() ?>
    </div>
    <div class="col-md-2">
        <?= $form->field($model, 'fuel_grade')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-2">
        <?= $form->field($model, 'front_suspension')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-2">
        <?= $form->field($model, 'rear_suspension')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-2">
        <?= $form->field($model, 'gearbox_type')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-2">
        <?= $form->field($model, 'number_of_gears')->textInput() ?>
    </div>

    <div class="clearfix"></div>

    <div class="col-md-2">
        <?= $form->field($model, 'drive_unit')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-2">
        <?= $form->field($model, 'front_brakes')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-2">
        <?= $form->field($model, 'rear_brakes')->textInput() ?>
    </div>
    <div class="col-md-2">
        <?= $form->field($model, 'curb_weight')->textInput()->label('Снар. масса (кг)') ?>
    </div>
    <div class="col-md-2">
        <?= $form->field($model, 'full_mass')->textInput() ?>
    </div>
    <div class="col-md-2">
        <?= $form->field($model, 'power_reserve')->textInput() ?>
    </div>

    <div class="clearfix"></div>

    <div class="col-md-2">
        <?= $form->field($model, 'max_speed')->textInput() ?>
    </div>
    <div class="col-md-2">
        <?= $form->field($model, 'acceleration_to_100')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-2">
        <?= $form->field($model, 'fuel_consumption_city_for_100')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'fuel_consumption_highway_for_100')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'fuel_consumption_mixed_cycle_for_100')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="clearfix"></div>

    <div class="col-md-2">
        <?= $form->field($model, 'eco_standard')->textInput() ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'max_torque_revolutions')->textInput() ?>
    </div>

    <div class="clearfix"></div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

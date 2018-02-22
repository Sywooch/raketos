<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model common\models\forms\MainFilterForm */
/* @var $idModal string */

$this->title = 'Главный фильтр';
?>
<div class="main-filter-form-view">
    <?php
    Modal::begin([
        'size' => 'modal-md',
        'header' => '<h1 class="text-center">'.Yii::t('app', 'Просмотр параметров').'</h1>',
        'toggleButton' => false,
        'id' => $idModal,
        'options' => [
            'tabindex' => false,
        ],
    ]);
    ?>
    <div class="supplier-extend-view">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'name',
                'body',
                'number_of_seats',
                'width',
                'length',
                'height',
                'wheelbase',
                'track_front',
                'trunk_volume_min',
                'trunk_volume_max',
                'rear_track',
                'ground_clearance',
                'engine_type',
                'engine_capacity',
                'engine_power',
                'turnover_of_max_power',
                'max_torque',
                'inlet_type',
                'cylinder_arrangement',
                'number_of_cylinders',
                'cylinder_diameter',
                'piston_stroke',
                'number_of_valves_per_cylinder',
                'fuel_grade',
                'front_suspension',
                'rear_suspension',
                'gearbox_type',
                'number_of_gears',
                'drive_unit',
                'front_brakes',
                'rear_brakes',
                'max_speed',
                'acceleration_to_100',
                'fuel_consumption_city_for_100',
                'fuel_consumption_highway_for_100',
                'fuel_consumption_mixed_cycle_for_100',
                'curb_weight',
                'full_mass',
                'fuel_tank_capacity',
                'power_reserve',
                'eco_standard',
                'max_torque_revolutions',
            ],
        ]) ?>
    </div>
    <?php Modal::end(); ?>
</div>

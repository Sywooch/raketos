<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use phpnt\bootstrapNotify\BootstrapNotify;
use yii\helpers\Url;
use yii\bootstrap\Collapse;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\MainFilterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Главный фильтр';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="col-md-12">
    <div class="ibox">
        <div class="ibox-content">
            <?= Collapse::widget([
                'items' => [
                    [
                        'label' => 'О данном разделе',
                        'content' => 'В данном разделе происходит управление главным фильтром (кружки на главной). Если добавляются текстовые значения, то разделяться они должны запятой и пробелом,
                                    для формирования массива для фильтра (например: пикап, внедорожник, микроавтобус).
                            ',
                    ],
                ]]); ?>
        </div>
    </div>
</div>

<div class="main-filter-form-index">
    <?= BootstrapNotify::widget() ?>
    <div class="col-md-12">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                <div id="editable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                    <div class="table-responsive">
                        <?php Pjax::begin(); ?>
                        <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'columns' => [
                                [
                                    'template' => '{update} {view}',
                                    'class' => 'yii\grid\ActionColumn',
                                    'buttons' => [
                                        'update' => function ($url, $model, $key) {
                                            /* @var $model \common\models\extend\UserExtend */
                                            $model = \common\models\forms\MainFilterForm::findOne($key);
                                            echo $this->render('modal-element-form', ['model' => $model, 'idModal' => 'modalForm-update'.$key, 'key' => $key]);
                                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', Url::to(['#']), [
                                                'data-toggle' => 'modal',
                                                'data-target' => '#modalForm-update'.$key,
                                            ]);
                                        },
                                        'view' => function ($url, $model, $key) {
                                            echo $this->render('view', ['model' => $model, 'idModal' => 'modalForm-view'.$key]);
                                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', Url::to(['#']), [
                                                'data-toggle' => 'modal',
                                                'data-target' => '#modalForm-view'.$key,
                                            ]);
                                        },
                                    ]
                                ],
                                [
                                    //'attribute' => 'online',
                                    'label' => Yii::t('app', 'Категория'),
                                    'format' => 'raw',
                                    'value' => function ($model, $key, $index, $column) {
                                        /* @var $model \common\models\forms\MainFilterForm */
                                        switch ($model->name) {
                                            case 'forest':
                                                return 'Для леса и дачи';
                                                break;
                                            case 'city':
                                                return 'Для города';
                                                break;
                                            case 'family':
                                                return 'Для семьи';
                                                break;
                                            case 'travel':
                                                return 'Для дальних поездок';
                                                break;
                                        }
                                        return false;
                                    },
                                    'filter' => false,
                                ],
                                [
                                    //'attribute' => 'online',
                                    'label' => 'Параметры поиска',
                                    'format' => 'raw',
                                    'value' => function ($model, $key, $index, $column) {
                                        /* @var $model \common\models\forms\MainFilterForm */
                                        $items = '';
                                        if ($model->body) {
                                            $items .= '<strong>'.$model->getAttributeLabel('body').'</strong>: '.$model->body.'<br>';
                                        }
                                        if ($model->number_of_seats) {
                                            $items .= '<strong>'.$model->getAttributeLabel('number_of_seats').'</strong>: '.$model->number_of_seats.'<br>';
                                        }
                                        if ($model->width) {
                                            $items .= '<strong>'.$model->getAttributeLabel('width').'</strong>: '.$model->width.'<br>';
                                        }
                                        if ($model->length) {
                                            $items .= '<strong>'.$model->getAttributeLabel('length').'</strong>: '.$model->length.'<br>';
                                        }
                                        if ($model->height) {
                                            $items .= '<strong>'.$model->getAttributeLabel('height').'</strong>: '.$model->height.'<br>';
                                        }
                                        if ($model->wheelbase) {
                                            $items .= '<strong>'.$model->getAttributeLabel('wheelbase').'</strong>: '.$model->wheelbase.'<br>';
                                        }
                                        if ($model->track_front) {
                                            $items .= '<strong>'.$model->getAttributeLabel('track_front').'</strong>: '.$model->track_front.'<br>';
                                        }
                                        if ($model->trunk_volume_min) {
                                            $items .= '<strong>'.$model->getAttributeLabel('trunk_volume_min').'</strong>: '.$model->trunk_volume_min.'<br>';
                                        }
                                        if ($model->trunk_volume_max) {
                                            $items .= '<strong>'.$model->getAttributeLabel('trunk_volume_max').'</strong>: '.$model->trunk_volume_max.'<br>';
                                        }
                                        if ($model->rear_track) {
                                            $items .= '<strong>'.$model->getAttributeLabel('rear_track').'</strong>: '.$model->rear_track.'<br>';
                                        }
                                        if ($model->ground_clearance) {
                                            $items .= '<strong>'.$model->getAttributeLabel('ground_clearance').'</strong>: '.$model->ground_clearance.'<br>';
                                        }
                                        if ($model->engine_type) {
                                            $items .= '<strong>'.$model->getAttributeLabel('engine_type').'</strong>: '.$model->engine_type.'<br>';
                                        }
                                        if ($model->engine_capacity) {
                                            $items .= '<strong>'.$model->getAttributeLabel('engine_capacity').'</strong>: '.$model->engine_capacity.'<br>';
                                        }
                                        if ($model->engine_power) {
                                            $items .= '<strong>'.$model->getAttributeLabel('engine_power').'</strong>: '.$model->engine_power.'<br>';
                                        }
                                        if ($model->turnover_of_max_power) {
                                            $items .= '<strong>'.$model->getAttributeLabel('turnover_of_max_power').'</strong>: '.$model->turnover_of_max_power.'<br>';
                                        }
                                        if ($model->max_torque) {
                                            $items .= '<strong>'.$model->getAttributeLabel('max_torque').'</strong>: '.$model->max_torque.'<br>';
                                        }
                                        if ($model->inlet_type) {
                                            $items .= '<strong>'.$model->getAttributeLabel('inlet_type').'</strong>: '.$model->inlet_type.'<br>';
                                        }
                                        if ($model->cylinder_arrangement) {
                                            $items .= '<strong>'.$model->getAttributeLabel('cylinder_arrangement').'</strong>: '.$model->cylinder_arrangement.'<br>';
                                        }
                                        if ($model->number_of_cylinders) {
                                            $items .= '<strong>'.$model->getAttributeLabel('number_of_cylinders').'</strong>: '.$model->number_of_cylinders.'<br>';
                                        }
                                        if ($model->cylinder_diameter) {
                                            $items .= '<strong>'.$model->getAttributeLabel('cylinder_diameter').'</strong>: '.$model->cylinder_diameter.'<br>';
                                        }
                                        if ($model->piston_stroke) {
                                            $items .= '<strong>'.$model->getAttributeLabel('piston_stroke').'</strong>: '.$model->piston_stroke.'<br>';
                                        }
                                        if ($model->number_of_valves_per_cylinder) {
                                            $items .= '<strong>'.$model->getAttributeLabel('number_of_valves_per_cylinder').'</strong>: '.$model->number_of_valves_per_cylinder.'<br>';
                                        }
                                        if ($model->fuel_grade) {
                                            $items .= '<strong>'.$model->getAttributeLabel('fuel_grade').'</strong>: '.$model->fuel_grade.'<br>';
                                        }
                                        if ($model->front_suspension) {
                                            $items .= '<strong>'.$model->getAttributeLabel('front_suspension').'</strong>: '.$model->front_suspension.'<br>';
                                        }
                                        if ($model->rear_suspension) {
                                            $items .= '<strong>'.$model->getAttributeLabel('rear_suspension').'</strong>: '.$model->rear_suspension.'<br>';
                                        }
                                        if ($model->gearbox_type) {
                                            $items .= '<strong>'.$model->getAttributeLabel('gearbox_type').'</strong>: '.$model->gearbox_type.'<br>';
                                        }
                                        if ($model->number_of_gears) {
                                            $items .= '<strong>'.$model->getAttributeLabel('number_of_gears').'</strong>: '.$model->number_of_gears.'<br>';
                                        }
                                        if ($model->drive_unit) {
                                            $items .= '<strong>'.$model->getAttributeLabel('drive_unit').'</strong>: '.$model->drive_unit.'<br>';
                                        }
                                        if ($model->front_brakes) {
                                            $items .= '<strong>'.$model->getAttributeLabel('front_brakes').'</strong>: '.$model->front_brakes.'<br>';
                                        }
                                        if ($model->rear_brakes) {
                                            $items .= '<strong>'.$model->getAttributeLabel('rear_brakes').'</strong>: '.$model->rear_brakes.'<br>';
                                        }
                                        if ($model->max_speed) {
                                            $items .= '<strong>'.$model->getAttributeLabel('max_speed').'</strong>: '.$model->max_speed.'<br>';
                                        }
                                        if ($model->acceleration_to_100) {
                                            $items .= '<strong>'.$model->getAttributeLabel('acceleration_to_100').'</strong>: '.$model->acceleration_to_100.'<br>';
                                        }
                                        if ($model->fuel_consumption_city_for_100) {
                                            $items .= '<strong>'.$model->getAttributeLabel('fuel_consumption_city_for_100').'</strong>: '.$model->fuel_consumption_city_for_100.'<br>';
                                        }
                                        if ($model->fuel_consumption_highway_for_100) {
                                            $items .= '<strong>'.$model->getAttributeLabel('fuel_consumption_highway_for_100').'</strong>: '.$model->fuel_consumption_highway_for_100.'<br>';
                                        }
                                        if ($model->fuel_consumption_mixed_cycle_for_100) {
                                            $items .= '<strong>'.$model->getAttributeLabel('fuel_consumption_mixed_cycle_for_100').'</strong>: '.$model->fuel_consumption_mixed_cycle_for_100.'<br>';
                                        }
                                        if ($model->curb_weight) {
                                            $items .= '<strong>'.$model->getAttributeLabel('curb_weight').'</strong>: '.$model->curb_weight.'<br>';
                                        }
                                        if ($model->full_mass) {
                                            $items .= '<strong>'.$model->getAttributeLabel('full_mass').'</strong>: '.$model->full_mass.'<br>';
                                        }
                                        if ($model->fuel_tank_capacity) {
                                            $items .= '<strong>'.$model->getAttributeLabel('fuel_tank_capacity').'</strong>: '.$model->fuel_tank_capacity.'<br>';
                                        }
                                        if ($model->power_reserve) {
                                            $items .= '<strong>'.$model->getAttributeLabel('power_reserve').'</strong>: '.$model->power_reserve.'<br>';
                                        }
                                        if ($model->eco_standard) {
                                            $items .= '<strong>'.$model->getAttributeLabel('eco_standard').'</strong>: '.$model->eco_standard.'<br>';
                                        }
                                        if ($model->max_torque_revolutions) {
                                            $items .= '<strong>'.$model->getAttributeLabel('max_torque_revolutions').'</strong>: '.$model->max_torque_revolutions.'<br>';
                                        }
                                        return $items;
                                    },
                                    'filter' => false,
                                ],
                                /*'body',
                                'number_of_seats',
                                'length',
                                'trunk_volume_max',
                                'engine_capacity',
                                'drive_unit',
                                'ground_clearance',*/
                            ],
                        ]); ?>
                        <?php Pjax::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


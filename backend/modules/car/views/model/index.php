<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use phpnt\bootstrapNotify\BootstrapNotify;
use yii\helpers\Url;
use yii\bootstrap\Collapse;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\CarModelSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $model \common\models\forms\CarModelForm */

$this->title = 'Модели автомобилей';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="col-md-12">
    <div class="ibox">
        <div class="ibox-content">
            <?= Collapse::widget([
                'items' => [
                    [
                        'label' => 'О данном разделе',
                        'content' => 'В данном разделе можно просмотреть характеристики любой модели автомобиля. Для этого нажмите <span class="glyphicon glyphicon-eye-open"></span> и заполните простую форму.<br>
                            ',
                    ],
                ]]); ?>
        </div>
    </div>
</div>

<div class="car-model-form-index">
    <?= BootstrapNotify::widget() ?>
    <div class="col-md-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <?= $this->render('modal-element-form',
                    [
                        'model' => $model,
                        'idModal' => 'modalElementForm'
                    ]); ?>
                <?/*= Html::button('<span class="glyphicon glyphicon-plus"></span> '.Yii::t('app', 'Добавить марку'), [
                    'class' => 'filter btn btn-primary',
                    'data-toggle' => 'modal',
                    'data-target' => '#modalElementForm',
                ]) */?>
            </div>
            <div class="ibox-content">
                <div id="editable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                    <div class="table-responsive">
                        <?php Pjax::begin([
                                //'id' => ''
                        ]); ?>
                        <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'columns' => [
                                [
                                    'template' => '{view}',
                                    'class' => 'yii\grid\ActionColumn',
                                    'buttons' => [

                                        'view' => function ($url, $model, $key) {
                                            /*echo $this->render('view', ['model' => $model, 'idModal' => 'modalForm-view'.$key]);
                                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', Url::to(['#']), [
                                                'data-toggle' => 'modal',
                                                'data-target' => '#modalForm-view'.$key,
                                            ]);*/
                                            return Html::a('<i class="glyphicon glyphicon-eye-open"></i>', Url::to(['/car/model/view', 'id' => $key]),
                                                [

                                                ]);
                                        },
                                    ],
                                    'contentOptions' => ['style'=>'max-width: 30px !important; width: 30px !important;'],
                                ],
                                /*[
                                    'class' => 'yii\grid\SerialColumn',
                                    'contentOptions' => ['style'=>'max-width: 20px !important; width: 20px !important;'],
                                ],*/
                                //'id_car_model',
                                [
                                    'attribute' => 'id_car_mark',
                                    'format' => 'raw',
                                    'value' => function ($model) {
                                        // @var $model \common\models\forms\CarModelForm
                                        return $model->mark->name;
                                    },
                                    'filter' => $searchModel->markList,
                                    'contentOptions' => ['style'=>'max-width: 80px !important; width: 80px !important;'],
                                ],
                                [
                                    'attribute' => 'name',
                                    'format' => 'raw',
                                    'value' => function ($model) {
                                        // @var $model \common\models\forms\CarModelForm
                                        return $model->name;
                                    },
                                    'contentOptions' => ['style'=>'max-width: 120px !important; width: 120px !important;'],
                                ],
                                /*[
                                    'attribute' => 'id_car_make',
                                    'format' => 'raw',
                                    'value' => function ($model) {
                                        // @var $model \common\models\forms\CarModelForm
                                        return $model->make->name;
                                    },
                                    'filter' => $searchModel->makeList,
                                    'contentOptions' => ['style'=>'max-width: 80px !important; width: 80px !important;'],
                                ],
                                [
                                    'attribute' => 'name',
                                    'format' => 'raw',
                                    'value' => function ($model) {
                                        // @var $model \common\models\forms\CarModelForm
                                        return $model->name;
                                    },
                                    'contentOptions' => ['style'=>'max-width: 120px !important; width: 120px !important;'],
                                ],*/
                            ],
                        ]); ?>
                        <?php Pjax::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


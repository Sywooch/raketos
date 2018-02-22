<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use phpnt\bootstrapNotify\BootstrapNotify;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\CarSpecificationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $model \common\models\forms\CarSpecificationForm */

$this->title = 'Характеристики';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="car-specification-form-index">
    <?= BootstrapNotify::widget() ?>
    <div class="col-md-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <?= $this->render('modal-element-form',
                    [
                        'model' => $model,
                        'idModal' => 'modalElementForm'
                    ]);?>
                <?/*= Html::button('<span class="glyphicon glyphicon-plus"></span> '.Yii::t('app', 'Добавить марку'), [
                    'class' => 'filter btn btn-primary',
                    'data-toggle' => 'modal',
                    'data-target' => '#modalElementForm',
                ]) */?>
            </div>
            <div class="ibox-content">
                <div id="editable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                    <div class="table-responsive">
                        <?php Pjax::begin(); ?>
                        <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'columns' => [
                                [
                                    'template' => '{view} {update}',
                                    'class' => 'yii\grid\ActionColumn',
                                    'buttons' => [
                                        'update' => function ($url, $model, $key) {
                                            /* @var $model \common\models\extend\UserExtend */
                                            $model = \common\models\forms\CarSpecificationForm::findOne($key);
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
                                    ],
                                    'contentOptions' => ['style'=>'max-width: 30px !important; width: 30px !important;'],
                                ],
                                [
                                    'class' => 'yii\grid\SerialColumn',
                                    'contentOptions' => ['style'=>'max-width: 20px !important; width: 20px !important;'],
                                ],
                                'name',
                                [
                                    'attribute' => 'id_parent',
                                    'format' => 'raw',
                                    'value' => function ($model) {
                                        /* @var $model \common\models\forms\CarSpecificationForm */
                                        if ($model->id_parent === null) {
                                            return false;
                                        } else {
                                            return $model->parent->name;
                                        }
                                    },
                                    'filter' => $searchModel->parentList,
                                    'contentOptions' => ['style'=>'max-width: 80px !important; width: 80px !important;'],
                                ],
                            ],
                        ]); ?>
                        <?php Pjax::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

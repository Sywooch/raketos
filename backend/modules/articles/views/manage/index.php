<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use phpnt\bootstrapNotify\BootstrapNotify;
use yii\helpers\Url;
use yii\bootstrap\Collapse;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $model \common\models\forms\ArticleForm */

$this->title = 'Статьи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-md-12">
    <div class="ibox">
        <div class="ibox-content">
            <?= Collapse::widget([
                'items' => [
                    [
                        'label' => 'О данном разделе',
                        'content' => 'В данном разделе происходит управления рубликой «Статьи».<br>
                                1. Управление происходит через кнопки <span class="glyphicon glyphicon-pencil"></span> <span class="glyphicon glyphicon-eye-open"></span> <span class="glyphicon glyphicon-trash"></span><br>
                            ',
                    ],
                ]]); ?>
        </div>
    </div>
</div>

<div class="article-form-index">
    <?= BootstrapNotify::widget() ?>
    <div class="col-md-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <?= $this->render('modal-element-form',
                    [
                        'model' => $model,
                        'idModal' => 'modalElementForm'
                    ]);?>
                <?= Html::button('<span class="glyphicon glyphicon-plus"></span> '.Yii::t('app', 'Добавить статью'), [
                    'class' => 'filter btn btn-primary',
                    'data-toggle' => 'modal',
                    'data-target' => '#modalElementForm',
                ]) ?>
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
                                    'template' => '{update} {view} {delete}',
                                    'class' => 'yii\grid\ActionColumn',
                                    'buttons' => [
                                        'update' => function ($url, $model, $key) {
                                            /* @var $model \common\models\extend\UserExtend */
                                            $model = \common\models\forms\ArticleForm::findOne($key);
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
                                ['class' => 'yii\grid\SerialColumn'],
                                'name',
                                'short_desc:ntext',
                                //'meta_keys',
                                //'meta_desc',
                                // 'text:ntext',
                                // 'user_id',
                                'created_at:date',
                                'updated_at:date',
                            ],
                        ]); ?>
                        <?php Pjax::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

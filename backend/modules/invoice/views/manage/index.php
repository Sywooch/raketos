<?php

use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Collapse;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\InvoiceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Счета');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="invoice-form-index">

    <div class="col-md-12">
        <div class="ibox">
            <div class="ibox-content">
                <?= Collapse::widget([
                    'items' => [
                        [
                            'label' => 'О данном разделе',
                            'content' => 'Здесь указаный все счета пользователей и их статус.',
                        ],
                    ]]); ?>
            </div>
        </div>
    </div>

    <div class="auth-item-extend-index">
        <div class="col-md-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h1><?= Yii::t('app', 'Счета пользователей') ?></h1>
                </div>
                <?php Pjax::begin(); ?>
                <div class="ibox-content">
                    <div id="editable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                        <div class="table-responsive">
                            <?= GridView::widget([
                                'dataProvider' => $dataProvider,
                                'filterModel' => $searchModel,
                                'columns' => [
                                    //['class' => 'yii\grid\SerialColumn'],

                                    'id',
                                    'sum',
                                    'id_ads',
                                    'id_tariff',
                                    'id_user',
                                    [
                                        'attribute' => 'status',
                                        'format' => 'raw',
                                        'value' => function ($model) {
                                            return $model->statusInvoice;
                                        },
                                        'filter' => $searchModel->statusList,
                                        'contentOptions' => ['style'=>'max-width: 120px !important; width: 120px !important;'],
                                    ],
                                    'created_at:date',
                                    // 'updated_at',

                                    //['class' => 'yii\grid\ActionColumn'],
                                ],
                            ]); ?>
                        </div>
                    </div>
                </div>
                <?php Pjax::end(); ?>
            </div>
        </div>
    </div>
</div>
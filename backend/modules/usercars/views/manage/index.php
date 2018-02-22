<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use phpnt\bootstrapNotify\BootstrapNotify;
use yii\helpers\Url;
use phpnt\bootstrapSelect\BootstrapSelectAsset;
use yii\bootstrap\Collapse;

use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\AdsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Объявления';
$this->params['breadcrumbs'][] = $this->title;

$statusList = ["" => "Нет"] + $searchModel->statusList;
$isPaidList = ["" => "Нет"] + $searchModel->isPaidList;
?>

<div class="col-md-12">
    <div class="ibox">
        <div class="ibox-content">
            <?= Collapse::widget([
                'items' => [
                    [
                        'label' => 'О данном разделе',
                        'content' => 'В данном разделе происходит управления объявлениями.<br>
                                        1. Назначить тариф для объявления - значок  <span class="glyphicon glyphicon-paperclip"></span>.<br>
                                        Для блокировки или активации объявления выделите один или более чекбоксов и нажните соответствующую кнопку внизу таблицы.
                            ',
                    ],
                ]]); ?>
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="ibox">
        <div class="ibox-title">
        <h2>Форма фильтрации</h2>
        </div>
        <div class="ibox-content">
            <div class="row">
            <?php $form = ActiveForm::begin([
                'id' => 'filter-form',
                'action' => ['index'],
                'method' => 'get',
            ]); ?>
            <div class="col-md-3">
                <?= $form->field($modelCarMarkSearch, 'name')->textInput() ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($modelCarModelSearch, 'name')->textInput() ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($modelCarGenerationSearch, 'name')->textInput() ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($modelCarSerieSearch, 'name')->textInput() ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($modelCarModificationSearch, 'name')->textInput() ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($searchModel, 'status')->dropDownList($statusList) ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($searchModel, 'is_paid')->dropDownList($isPaidList) ?>
            </div>
            <div class="col-md-12">
                <?= Html::submitButton('Фильтрация', ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Сбросить', ['index'], ['class' => 'btn btn-danger']) ?>
            </div>
            <br />
            <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>

<div class="ads-form-index">
    <div class="col-md-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
            <h2>Объявления</h2>
                <?/*= $this->render('modal-element-form',
                    [
                        'model' => $model,
                        'idModal' => 'modalElementForm'
                    ]);*/?>
            </div>
            <div class="ibox-content">
                <?php Pjax::begin(['id' => 'usercarsGridBlock']); ?>
                <?php
                BootstrapSelectAsset::register($this);
                ?>
                <?= BootstrapNotify::widget() ?>
                <div id="editable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                    <div class="table-responsive">
                        <?= GridView::widget([
                            'id'            => 'usercarsGrid',
                            'dataProvider' => $dataProvider,
                            //'filterModel' => $searchModel,
                            'columns' => [
                                //['class' => 'yii\grid\SerialColumn'],
                                [
                                    'template' => '{tariff}',
                                    'class' => 'yii\grid\ActionColumn',
                                    'buttons' => [
                                        'tariff' => function ($url, $model, $key) {
                                            /* @var $model \common\models\extend\UserExtend */
                                            $model = \common\models\forms\AdsForm::findOne($key);
                                            echo $this->render('modal-tariff-form', ['model' => $model, 'idModal' => 'modalForm-update'.$key, 'key' => $key]);
                                            return Html::a('<span class="glyphicon glyphicon-paperclip"></span>', Url::to(['#']), [
                                                'data-toggle' => 'modal',
                                                'data-target' => '#modalForm-update'.$key,
                                            ]);
                                        },
                                        /*'update' => function ($url, $model, $key) {
                                            // @var $model \common\models\extend\UserExtend
                                            $model = \common\models\forms\UserForm::findOne($key);
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
                                        'email' => function ($url, $model, $key) {
                                            echo $this->render('modal-email-form', ['model' => $model, 'idModal' => 'modalEmailForm-view'.$key]);
                                            return Html::a('<span class="glyphicon glyphicon-envelope"></span>', Url::to(['#']), [
                                                'data-toggle' => 'modal',
                                                'data-target' => '#modalEmailForm-view'.$key,
                                            ]);
                                        },*/
                                    ],
                                    'contentOptions' => ['style'=>'max-width: 30px !important; width: 30px !important;'],
                                ],
                                [
                                    'class' => 'yii\grid\CheckboxColumn',
                                ],
                                [
                                    'attribute' => 'id',
                                    'format' => 'raw',
                                    'value' => function ($model) {
                                        /* @var $model \common\models\forms\AdsForm */
                                        return $model->id;
                                    },
                                    //'filter' => $searchModel->statusList,
                                    'contentOptions' => ['style'=>'max-width: 20px !important; width: 20px !important;'],
                                ],
                                [
                                    'label' => 'Изображение',
                                    'format' => 'html',
                                    'value' => function ($data, $f) {
                                        /* @var $data \common\models\extend\UserExtend */
                                        $images = '';
                                        $i = 1;
                                        foreach($data->imagesMain as $one):
                                            /* @var $one \phpnt\cropper\models\Photo */
                                            if($i == 1) {
                                                $images .= Html::img(\Yii::$app->params['frontendUrl'].'/'.$one->file_small,
                                                    [
                                                        'width' => '100px',
                                                        'style' => 'margin: 1px;',
                                                        //'class' => 'img-circle'
                                                    ]);
                                            } else {
                                                break;
                                            }
                                            $i++;
                                        endforeach;
                                        if($images){
                                            return $images;
                                        }else{
                                            return Html::img(\Yii::$app->params['frontendUrl'].'/img/nologo.png',
                                                [
                                                    'width' => '100px',
                                                    'style' => 'margin: 1px;',
                                                    //'class' => 'img-circle'
                                                ]);
                                        }
                                    },
                                    'contentOptions' => ['style' => 'width:120px;  min-width:120px;  '],
                                ],
                                [
                                    'label' => 'Изображение',
                                    'format' => 'html',
                                    'value' => function ($data, $f) {
                                        /* @var $data \common\models\extend\AdsExtend */
                                        $images = '';
                                        $i = 1;
                                        foreach($data->imagesOther as $one):
                                            /* @var $one \phpnt\cropper\models\Photo */
                                            $images .= Html::img(\Yii::$app->params['frontendUrl'].'/'.$one->file_small,
                                                [
                                                    'width' => '100px',
                                                    'style' => 'margin: 1px;',
                                                    //'class' => 'img-circle'
                                                ]);
                                        endforeach;
                                        if($images){
                                            return $images;
                                        }else{
                                            return Html::img('/images/nologo.png',
                                                [
                                                    'width' => '100px',
                                                    'style' => 'margin: 1px;',
                                                    //'class' => 'img-circle'
                                                ]);
                                        }
                                    },
                                    'contentOptions' => ['style' => 'width:120px;  min-width:120px;  '],
                                ],
                                [
                                    'attribute' => 'id_car_mark',
                                    'format' => 'raw',
                                    'value' => function ($model) {
                                        /* @var $model \common\models\forms\AdsForm */
                                        return $model->mark->name;
                                    },
                                    //'filter' => $searchModel->statusList,
                                    'contentOptions' => ['style'=>'max-width: 140px !important; width: 140px !important;'],
                                ],
                                [
                                    'attribute' => 'id_car_model',
                                    'format' => 'raw',
                                    'value' => function ($model) {
                                        /* @var $model \common\models\forms\AdsForm */
                                        return $model->model->name;
                                    },
                                    //'filter' => $searchModel->statusList,
                                    'contentOptions' => ['style'=>'max-width: 140px !important; width: 140px !important;'],
                                ],
                                /*[
                                    'attribute' => 'id_car_generation',
                                    'format' => 'raw',
                                    'value' => function ($model) {
                                        // @var $model \common\models\forms\AdsForm
                                        return $model->generation->name;
                                    },
                                    //'filter' => $searchModel->statusList,
                                    'contentOptions' => ['style'=>'max-width: 140px !important; width: 140px !important;'],
                                ],*/
                                [
                                    'attribute' => 'id_car_serie',
                                    'format' => 'raw',
                                    'value' => function ($model) {
                                        /* @var $model \common\models\forms\AdsForm */
                                        if ($model->serie) {
                                            return $model->serie->name;
                                        } else {
                                            return '';
                                        }
                                    },
                                    //'filter' => $searchModel->statusList,
                                    'contentOptions' => ['style'=>'max-width: 140px !important; width: 140px !important;'],
                                ],
                                [
                                    'attribute' => 'id_car_modification',
                                    'format' => 'raw',
                                    'value' => function ($model) {
                                        /* @var $model \common\models\forms\AdsForm */
                                        if ($model->modification) {
                                            return $model->modification->name;
                                        } else {
                                            return '';
                                        }
                                    },
                                    //'filter' => $searchModel->statusList,
                                    'contentOptions' => ['style'=>'max-width: 140px !important; width: 140px !important;'],
                                ],
                                [
                                    'attribute' => 'status',
                                    'format' => 'raw',
                                    'value' => function ($model) {
                                        /* @var $model \common\models\forms\AdsForm */
                                        return $model->statusAds;
                                    },
                                    'filter' => $searchModel->statusList,
                                    'contentOptions' => ['style'=>'max-width: 120px !important; width: 120px !important;'],
                                ],
                                [
                                    //'attribute' => 'user_id',
                                    'label' => 'Баланс пол-ля',
                                    'format' => 'raw',
                                    'value' => function ($model) {
                                        /* @var $model \common\models\forms\AdsForm */
                                        return $model->user->balance;
                                    },
                                    'filter' => false,
                                    'contentOptions' => ['style'=>'max-width: 30px !important; width: 30px !important;'],
                                ],
                                [
                                    'attribute' => 'is_paid',
                                    //'label' => 'Баланс пользователя',
                                    'format' => 'raw',
                                    'value' => function ($model) {
                                        /* @var $model \common\models\extend\AdsExtend */
                                        if ($model->is_paid) {
                                            return 'да';
                                        }
                                        return 'нет';
                                    },
                                    'filter' => $searchModel->isPaidList,
                                    'contentOptions' => ['style'=>'max-width: 60px !important; width: 60px !important;'],
                                ],
                                [
                                    'attribute' => 'end_paid',
                                    //'label' => 'Баланс пользователя',
                                    'format' => 'raw',
                                    'value' => function ($model) {
                                        /* @var $model \common\models\extend\AdsExtend */
                                        if ($model->end_paid) {
                                            return Yii::$app->formatter->asDate($model->end_paid, 'short');
                                        }
                                        return '-';
                                    },
                                    'filter' => false,
                                    'contentOptions' => ['style'=>'max-width: 60px !important; width: 60px !important;'],
                                ],
                                // 'id_car_modification',
                                // 'mileage',
                                // 'power_ptc',
                                // 'mileage_rus',
                                // 'doc',
                                // 'broken',
                                // 'work',
                                // 'vin',
                                // 'num_reg',
                                // 'desc:ntext',
                                // 'price',
                                // 'exchange',
                                // 'user_id',
                                // 'city_id',
                                // 'address',
                                // 'image_main',
                                // 'images',
                                // 'temp',
                                // 'status',
                                // 'created_at',
                                // 'updated_at',

                                //['class' => 'yii\grid\ActionColumn'],
                            ],
                        ]); ?>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <h3>Выбранные</h3>
                <?= Html::button('<i class="fa fa-check" aria-hidden="true"></i> Активировать',
                    [
                        'class' => 'btn btn-primary',
                        'onclick' => '
                                        var keys = $(".grid-view").yiiGridView("getSelectedRows");
                                        $.pjax({
                                            type: "POST",
                                            url: "' . Url::to(['/usercars/manage/multiactive']) . '",
                                            data:{keys: keys},
                                            container: "#usercarsGridBlock",
                                            push: false,
                                            scrollTo: false
                                        })'
                    ])?>
                <?= Html::button('<i class="fa fa-ban" aria-hidden="true"></i> Заблокировать',
                    [
                        'class' => 'btn btn-warning',
                        'onclick' => '
                                var keys = $(".grid-view").yiiGridView("getSelectedRows");
                                $.pjax({
                                    type: "POST",
                                    url: "' . Url::to(['/usercars/manage/multiblock']) . '",
                                    data:{keys: keys},
                                    container: "#usercarsGridBlock",
                                    push: false,
                                    scrollTo: false
                                })'
                    ])?>

                <?= Html::button('<i class="fa fa-times" aria-hidden="true"></i> Удалить',
                    [
                        'class' => 'btn btn-danger',
                        'onclick' => '
                                var keys = $(".grid-view").yiiGridView("getSelectedRows");
                                $.pjax({
                                    type: "POST",
                                    url: "' . Url::to(['/usercars/manage/multidelete']) . '",
                                    data:{keys: keys},
                                    container: "#usercarsGridBlock",
                                    push: false,
                                    scrollTo: false
                                })'
                    ])?>
                <div class="hr-line-dashed"></div>
                <?php Pjax::end(); ?>
            </div>
        </div>
    </div>
</div>

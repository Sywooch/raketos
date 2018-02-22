<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use phpnt\bootstrapNotify\BootstrapNotify;
use yii\helpers\Url;
use yii\bootstrap\Collapse;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\QuestionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Вопрос - Ответ';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="col-md-12">
    <div class="ibox">
        <div class="ibox-content">
            <?= Collapse::widget([
                'items' => [
                    [
                        'label' => 'О данном разделе',
                        'content' => 'В данном разделе происходит управления рубликой «Вопрос - ответ».<br>
                                1. Управление происходит через кнопки <span class="glyphicon glyphicon-comment"></span> <span class="glyphicon glyphicon-eye-open"></span> <span class="glyphicon glyphicon-trash"></span><br>
                                2. После ответа на письмо, пользователю приходит сообщение на эл. почту с полученным ответом.<br>
                                3. Только «Активные» объявления отображаются на основном сайте.
                            ',
                    ],
                ]]); ?>
        </div>
    </div>
</div>

<div class="question-form-index">
    <div class="col-md-12">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                <?php Pjax::begin(['id' => 'userGridBlock']); ?>
                <?= BootstrapNotify::widget() ?>
                <div id="editable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                    <div class="table-responsive">
                        <?= GridView::widget([
                            'id' => 'userGrid',
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'columns' => [
                                [
                                    'template' => '{update} {view} {delete}',
                                    'class' => 'yii\grid\ActionColumn',
                                    'buttons' => [
                                        'update' => function ($url, $model, $key) {
                                            /* @var $model \common\models\forms\QuestionForm */
                                            $model = \common\models\forms\QuestionForm::findOne($key);
                                            echo $this->render('modal-element-form', ['model' => $model, 'idModal' => 'modalForm-update'.$key, 'key' => $key]);
                                            return Html::a('<span class="glyphicon glyphicon-comment"></span>', Url::to(['#']), [
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
                                    'class' => 'yii\grid\CheckboxColumn',
                                ],
                                'question',
                                'answer',
                                [
                                    'attribute' => 'status',
                                    'format' => 'raw',
                                    'value' => function ($model) {
                                        /* @var $model \common\models\forms\QuestionForm */
                                        return $model->statusQuestion;
                                    },
                                    'filter' => $searchModel->statusList,
                                    'contentOptions' => ['style'=>'max-width: 120px !important; width: 120px !important;'],
                                ],
                                //'user_id',
                                'created_at:date',
                                [
                                    'label' => 'Ответили',
                                    'format' => 'raw',
                                    'value' => function ($model) {
                                        /* @var $model \common\models\forms\QuestionForm */
                                        return Yii::$app->formatter->asDate($model->updated_at);
                                    },
                                    'filter' => false,
                                    'contentOptions' => ['style'=>'max-width: 120px !important; width: 120px !important;'],
                                ],
                                // 'updated_at',
                            ]]); ?>
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
                                            url: "' . Url::to(['/questions/manage/multiactive']) . '",
                                            data:{keys: keys},
                                            container: "#userGridBlock",
                                            push: false,
                                            scrollTo: false
                                        })'
                    ])?>
                <?= Html::button('<i class="fa fa-ban" aria-hidden="true"></i> Заблокировать',
                    [
                        'class' => 'btn btn-danger',
                        'onclick' => '
                                        var keys = $(".grid-view").yiiGridView("getSelectedRows");
                                        $.pjax({
                                            type: "POST",
                                            url: "' . Url::to(['/questions/manage/multiblock']) . '",
                                            data:{keys: keys},
                                            container: "#userGridBlock",
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
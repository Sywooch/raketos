<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use phpnt\bootstrapNotify\BootstrapNotify;
use yii\helpers\Url;
use yii\bootstrap\Collapse;


/* @var $this yii\web\View */
/* @var $searchModel common\models\search\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $model \common\models\forms\UserForm */

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="col-md-12">
    <div class="ibox">
        <div class="ibox-content">
            <?= Collapse::widget([
                'items' => [
                    [
                        'label' => 'О данном разделе',
                        'content' => 'В данном разделе происходит управления пользователями.<br>
                            1.	Редактировать данные пользователя - значок  <span class="glyphicon glyphicon-pencil"></span>.<br>
                            2.	Просматривать данные пользователя - значок  <span class="glyphicon glyphicon-eye-open"></span>.<br>
                            3.	Отправить письмо на эл. почту пользователя-  значок  <span class="glyphicon glyphicon-envelope"></span>.<br>
                            Для блокировки или активации пользователей выделите один или более чекбоксов и нажните соответствующую кнопку внизу таблицы.
                            ',
                    ],
                ]]); ?>
        </div>
    </div>
</div>

<div class="user-form-index">
    <div class="col-md-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <?= $this->render('modal-element-form',
                    [
                        'model' => $model,
                        'idModal' => 'modalElementForm'
                    ]);?>
            </div>
            <div class="ibox-content">
                <?php Pjax::begin(['id' => 'userGridBlock']); ?>
                <?= BootstrapNotify::widget() ?>
                <div id="editable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                    <div class="table-responsive">
                        <?= GridView::widget([
                            'id'            => 'userGrid',
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'columns' => [
                                [
                                    'template' => '{update} {view} {email}',
                                    'class' => 'yii\grid\ActionColumn',
                                    'buttons' => [
                                        'update' => function ($url, $model, $key) {
                                            /* @var $model \common\models\extend\UserExtend */
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
                                        },
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
                                        return $model->id;
                                    },
                                    'contentOptions' => ['style'=>'max-width: 60px !important; width: 60px !important;'],
                                ],
                                [
                                    'label' => 'Аватар',
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
                                                        'class' => 'img-circle'
                                                    ]);
                                            } else {
                                                break;
                                            }
                                            $i++;
                                        endforeach;
                                        if($images){
                                            return $images;
                                        }else{
                                            return Html::img('/images/no-avatar.png',
                                                [
                                                    'width' => '100px',
                                                    'style' => 'margin: 1px;',
                                                    'class' => 'img-circle'
                                                ]);
                                        }
                                    },
                                    'contentOptions' => ['style' => 'width:120px;  min-width:120px;  '],
                                ],
                                'phone',
                                'email:email',
                                //'first_name',
                                // 'last_name',
                                // 'middle_name',
                                'balance',
                                // 'image_main',
                                // 'images',
                                // 'directory',
                                [
                                    'attribute' => 'status',
                                    'format' => 'raw',
                                    'value' => function ($model) {
                                        return $model->statusUser;
                                    },
                                    'filter' => $searchModel->statusList,
                                    'contentOptions' => ['style'=>'max-width: 120px !important; width: 120px !important;'],
                                ],
                                [
                                    //'attribute' => 'online',
                                    'label' => Yii::t('app', 'Онлайн'),
                                    'format' => 'raw',
                                    'value' => function ($model, $key, $index, $column) {
                                        /* @var $model \common\models\forms\UserForm */
                                        if (isset($model->onlineMark)) {
                                            return $model->onlineMark;
                                        }
                                        return null;
                                    },
                                    'filter' => false,
                                ],
                                [
                                    //'attribute' => 'online',
                                    'label' => Yii::t('app', 'Последний визит'),
                                    'format' => 'raw',
                                    'value' => function ($model, $key, $index, $column) {
                                        /* @var $model \common\models\forms\UserForm */
                                        if (isset($model->userOnline->online) && $model->userOnline->online) {
                                            return Yii::$app->formatter->asDate($model->userOnline->online);
                                        }
                                        return null;
                                    },
                                    'filter' => false,
                                ],
                                // 'password_hash',
                                // 'password_encrypted',
                                // 'auth_key',
                                // 'password_reset_token',
                                // 'email_confirm_token:email',
                                'addprofiles:boolean',
                                'created_at:date',
                                // 'updated_at',
                            ],
                        ]); ?>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="col-md-12">
                <h3>Выбранные</h3>
                <?= Html::button('<i class="fa fa-check" aria-hidden="true"></i> Активировать',
                    [
                        'class' => 'btn btn-primary',
                        'onclick' => '
                                        var keys = $(".grid-view").yiiGridView("getSelectedRows");
                                        $.pjax({
                                            type: "POST",
                                            url: "' . Url::to(['/user/manage/multiactive']) . '",
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
                                    url: "' . Url::to(['/user/manage/multiblock']) . '",
                                    data:{keys: keys},
                                    container: "#userGridBlock",
                                    push: false,
                                    scrollTo: false
                                })'
                    ])?>
                </div>
                <?php Pjax::end(); ?>
            </div>
        </div>
    </div>
</div>

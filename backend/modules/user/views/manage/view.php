<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model common\models\forms\UserForm */
/* @var $idModal string */

$this->title = 'Пользователи';
?>
<div class="user-form-view">
    <?php
    Modal::begin([
        'size' => 'modal-lg',
        'header' => '<h1 class="text-center">'.Yii::t('app', 'Просмотр пользователя').'</h1>',
        'toggleButton' => false,
        'id' => $idModal,
        'options' => [
            'tabindex' => false,
        ],
    ]);
    ?>
    <div class="row">
        <div class="col-md-12">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    /*'username',*/
                    'phone',
                    'email:email',
                    /*'first_name',
                    'last_name',
                    'middle_name',*/
                    /*'balance',
                    'image_main',
                    'images',
                    'directory',
                    'status',
                    'password_hash',
                    'password_encrypted',
                    'auth_key',
                    'password_reset_token',
                    'email_confirm_token:email',*/
                    'created_at:date',
                    'updated_at:date',
                ],
            ]) ?>
        </div>
    </div>
    <?php Modal::end(); ?>
</div>
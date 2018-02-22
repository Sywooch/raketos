<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model common\models\forms\CarSpecificationForm */
/* @var $idModal string */

$this->title = 'Характеристики';
?>
<div class="car-specification-form-view">
    <?php
    Modal::begin([
        'size' => 'modal-md',
        'header' => '<h1 class="text-center">'.Yii::t('app', 'Просмотр характеристики').'</h1>',
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
            'name',
            [
                'attribute' => 'id_parent',
                'format' => 'raw',
                'value' => call_user_func(function ($data) {
                    /* @var $data \common\models\forms\CarSpecificationForm */
                    if ($data->id_parent === null) {
                        return false;
                    } else {
                        return $data->parent->name;
                    }
                }, $model),
            ],
        ],
    ]) ?>
    </div>
    <?php Modal::end(); ?>
</div>

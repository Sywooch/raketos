<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model common\models\forms\ArticleForm */
/* @var $idModal string */

$this->title = 'Полезная информация';
?>
<div class="article-form-view">
    <?php
    Modal::begin([
        'size' => 'modal-lg',
        'header' => '<h1 class="text-center">'.Yii::t('app', 'Просмотр информацию').'</h1>',
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
                'id',
                'name',
                'short_desc:ntext',
                'meta_keys',
                'meta_desc',
                [
                    'attribute' => 'text',
                    'format' => 'raw',
                    'value' => call_user_func(function ($data) {
                        /* @var $data \common\models\forms\DocumentForm */
                        return $data->text;
                    }, $model),
                ],
                //'user_id',
                'created_at:date',
                'updated_at:date',
            ],
        ]) ?>
    </div>
    <?php Modal::end(); ?>
</div>

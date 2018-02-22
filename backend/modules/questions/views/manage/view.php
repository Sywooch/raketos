<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model common\models\forms\QuestionForm */
/* @var $idModal string */

$this->title = 'Вопрос - Ответ';
?>
<div class="question-form-view">
    <?php
    Modal::begin([
        'size' => 'modal-md',
        'header' => '<h1 class="text-center">'.Yii::t('app', 'Просмотр вопроса').'</h1>',
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
            'question',
            'answer',
            'status',
            'user_id',
            'created_at',
            'updated_at',
        ],
    ]) ?>
    </div>
    <?php Modal::end(); ?>
</div>


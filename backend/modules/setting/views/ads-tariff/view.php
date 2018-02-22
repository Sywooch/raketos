<?php

use yii\widgets\DetailView;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model common\models\forms\AdsTariffForm */
/* @var $idModal string */

$this->title = 'Тарифы';
?>
<div class="ads-tariff-form-view">
    <?php
    Modal::begin([
        'size' => 'modal-md',
        'header' => '<h1 class="text-center">'.Yii::t('app', 'Просмотр марки').'</h1>',
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
            'period',
            'price',
        ],
    ]) ?>
    </div>
    <?php Modal::end(); ?>
</div>

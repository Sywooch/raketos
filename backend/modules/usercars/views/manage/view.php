<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\forms\AdsForm */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ads Forms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ads-form-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_car_mark',
            'id_car_model',
            'id_car_generation',
            'id_car_serie',
            'id_car_modification',
            'mileage',
            'power_ptc',
            'mileage_rus',
            'doc',
            'broken',
            'work',
            'vin',
            'num_reg',
            'desc:ntext',
            'price',
            'exchange',
            'user_id',
            'city_id',
            'address',
            'image_main',
            'images',
            'temp',
            'status',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>

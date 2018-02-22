<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\forms\CarGenerationForm */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Car Generation Forms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="car-generation-form-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_car_generation], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_car_generation], [
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
            'id_car_generation',
            'name',
            'id_car_model',
            'year_begin',
            'year_end',
        ],
    ]) ?>

</div>

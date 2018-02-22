<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\forms\CarGenerationForm */

$this->title = 'Update Car Generation Form: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Car Generation Forms', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id_car_generation]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="car-generation-form-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

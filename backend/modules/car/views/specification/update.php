<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\forms\CarSpecificationForm */

$this->title = 'Update Car Specification Form: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Car Specification Forms', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id_car_specification]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="car-specification-form-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\forms\CarMakeForm */

$this->title = 'Update Car Make Form: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Car Make Forms', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id_car_make]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="car-make-form-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

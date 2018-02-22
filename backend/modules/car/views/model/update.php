<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\forms\CarModelForm */

$this->title = 'Update Car Model Form: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Car Model Forms', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id_car_model]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="car-model-form-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

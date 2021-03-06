<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\forms\CarSpecificationForm */

$this->title = 'Create Car Specification Form';
$this->params['breadcrumbs'][] = ['label' => 'Car Specification Forms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="car-specification-form-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

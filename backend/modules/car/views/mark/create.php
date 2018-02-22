<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\forms\CarMakeForm */

$this->title = 'Create Car Make Form';
$this->params['breadcrumbs'][] = ['label' => 'Car Make Forms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="car-make-form-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

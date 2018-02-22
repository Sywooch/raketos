<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\forms\CarModelForm */

$this->title = 'Create Car Model Form';
$this->params['breadcrumbs'][] = ['label' => 'Car Model Forms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="car-model-form-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

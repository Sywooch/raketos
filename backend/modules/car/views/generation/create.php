<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\forms\CarGenerationForm */

$this->title = 'Create Car Generation Form';
$this->params['breadcrumbs'][] = ['label' => 'Car Generation Forms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="car-generation-form-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

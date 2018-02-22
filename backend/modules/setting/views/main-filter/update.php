<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\forms\MainFilterForm */

$this->title = 'Update Main Filter Form: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Main Filter Forms', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="main-filter-form-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

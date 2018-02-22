<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\forms\InvoiceForm */

$this->title = 'Update Invoice Form: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Invoice Forms', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="invoice-form-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

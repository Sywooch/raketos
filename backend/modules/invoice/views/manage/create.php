<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\forms\InvoiceForm */

$this->title = 'Create Invoice Form';
$this->params['breadcrumbs'][] = ['label' => 'Invoice Forms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="invoice-form-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\forms\AdsForm */

$this->title = 'Update Ads Form: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ads Forms', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ads-form-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

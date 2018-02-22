<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\forms\AdsTariffForm */

$this->title = 'Create Ads Tariff Form';
$this->params['breadcrumbs'][] = ['label' => 'Ads Tariff Forms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ads-tariff-form-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

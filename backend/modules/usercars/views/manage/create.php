<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\forms\AdsForm */

$this->title = 'Create Ads Form';
$this->params['breadcrumbs'][] = ['label' => 'Ads Forms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ads-form-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

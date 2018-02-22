<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\forms\MainFilterForm */

$this->title = 'Create Main Filter Form';
$this->params['breadcrumbs'][] = ['label' => 'Main Filter Forms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="main-filter-form-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

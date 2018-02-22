<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\forms\QuestionForm */

$this->title = 'Update Question Form: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Question Forms', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="question-form-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

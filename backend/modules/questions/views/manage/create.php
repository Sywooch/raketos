<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\forms\QuestionForm */

$this->title = 'Create Question Form';
$this->params['breadcrumbs'][] = ['label' => 'Question Forms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="question-form-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\forms\DocumentForm */

$this->title = 'Изменить страницу: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="document-form-update">
    <div class="col-md-12">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                <?= $this->render('_form', [
                    'model' => $model,
                ]) ?>
            </div>
        </div>
    </div>
</div>


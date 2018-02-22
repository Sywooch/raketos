<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \common\models\extend\DocumentExtend */
/* @var $this yii\web\View */

$this->title = $model->name;
?>
<div class="col-md-12">
    <h1><?= $this->title ?></h1>
</div>
<div class="col-md-12">
    <?= $model->text ?>
</div>




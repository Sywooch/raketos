<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\extend\AuthItemExtend */

$this->title = Yii::t('app', 'Create Auth Item Extend');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Auth Item Extends'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-item-extend-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

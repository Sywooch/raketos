<?php
/**
 * Created by PhpStorm.
 * User: Raketos
 * Date: 28.05.2016
 * Time: 23:43
 */

use yii\bootstrap\Modal;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $widget \common\widgets\AuthWidget\AuthWidget */
/* @var $modelSignupForm \frontend\models\SignupForm */

$modelSignupForm = $widget->modelSignupForm;
?>
<?= Html::a('<i class="fa fa-pencil-square-o" aria-hidden="true" style="margin-right: 5px;"></i>Регистрация', ['#'],
    [
        'class' => 'black-link float-ld-md-right',
        'data-toggle' => 'modal',
        'data-target' => '#signinModal',
        'style' => 'outline: none;',
    ]) ?><br>
<?php
Modal::begin([
    'id' => 'signinModal',
    'header' => '<h2 class="text-center">'.\Yii::t('app', 'Регистрация пользователя').'</h2>',
    'toggleButton' => false,
]);
?>
    <div class="row" style="padding-left: 15px; padding-right: 15px;">
        <?= $this->render('@frontend/views/site/_signup-form', ['model' => $modelSignupForm]) ?>
    </div>
<?php
Modal::end();
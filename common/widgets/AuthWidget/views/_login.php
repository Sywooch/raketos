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
/* @var $modelLoginForm \common\models\forms\LoginForm */

$modelLoginForm = $widget->modelLoginForm;
?>
<?= Html::a('<i class="fa fa-user" aria-hidden="true" style="margin-right: 5px;"></i>Войти в ЛК', ['#'],
    [
        'class' => 'black-link float-ld-md-right',
        'data-toggle' => 'modal',
        'data-target' => '#loginModal',
        'style' => 'outline: none; margin-right: 20px;',
    ]) ?>
<?php
Modal::begin([
    'id' => 'loginModal',
    'header' => '<h2 class="text-center">Вход в личный кабинет</h2>',
    'toggleButton' => false,
]);
?>
    <div class="row" style="padding-left: 15px; padding-right: 15px;">
        <?= $this->render('@frontend/views/site/_login-form', ['model' => $modelLoginForm]) ?>
    </div>
<?php
Modal::end();
?>
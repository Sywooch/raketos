<?php
/**
 * Created by PhpStorm.
 * User: Raketos - http://raketos.ru
 * Date: 31.03.2017
 * Time: 14:51
 */

use yii\bootstrap\Modal;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $idModal string */
/* @var $model \common\models\forms\UserForm */
?>
<?php
//dd($model);
?>
<?php
$header = Yii::t('app', 'Отправить письмо пользователю');
Modal::begin([
    'size' => 'modal-md',
    'header' => '<h1 class="text-center">'.$header.'</h1>',
    'toggleButton' => false,
    'id' => $idModal,
    'options' => [
        'tabindex' => false
    ],
]);
?>
<?php $form = ActiveForm::begin([
    'action' => Url::to(['send-email', 'id' => $model->id]),
    'options' => ['data-pjax' => true],
]); ?>

    <div class="col-md-12">
        <h3>Получатель: <?= $model->email ?></h3>
    </div>

    <div class="col-md-12">
        <?= $form->field($model, 'message')->textarea(['row' => '6']) ?>
    </div>

    <div class="form-group text-center">
        <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>

<?php Modal::end(); ?>
<?php
/**
 * Created by PhpStorm.
 * User: Raketos - http://raketos.ru
 * Date: 11.05.2017
 * Time: 10:54
 */

/* @var $model \common\models\forms\AdsForm */
/* @var $user \common\models\Identity */
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'Пополнить баланс';
$user = Yii::$app->user->identity;
?>
<div class="col-md-12" style="margin-top: 80px;">
    <?php if ($model && $tariff): ?>

        <?php $form = ActiveForm::begin([
            'id'    => 'form-tariff',
            'method'    => 'POST',
            'action' => Url::to('https://demomoney.yandex.ru/eshop.xml'),
            'options' => ['data-pjax' => false],
        ]); ?>

        <?php
        /*d($data);*/
        ?>

        <div class="form-group text-center" style="margin-top: 30px;">
            <h3>Стоимость: <?= $tariff->price ?>.00 руб.</h3>
            <?= Html::hiddenInput('shopId', '132979') ?>
            <?= Html::hiddenInput('scid', '553250') ?>
            <?= Html::hiddenInput('customerNumber', $user->email)   // email пользователя ?>
            <?= Html::hiddenInput('orderNumber', time().'-'.$model->id.'-'.$tariff->id)        // id объявления и id тарифа ?>
            <?= Html::hiddenInput('sum', $tariff->price.'.00') ?>
            <?= Html::submitButton('Оплатить', ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

        <?php /*else: */?><!--

    <form action="https://demomoney.yandex.ru/eshop.xml" method="POST">

        <input name="shopId" value="132979" type="hidden">
        <input name="scid" value="553250" type="hidden">

        <input name="customerNumber" value="Покупатель N1" type="hidden">
        <input name="sum" value="100.00" type="text">

        <button type="submit">Заплатить</button>
    </form>-->

    <?php endif; ?>

</div>

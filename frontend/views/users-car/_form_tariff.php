<?php
/**
 * Created by PhpStorm.
 * User: Raketos - http://raketos.ru
 * Date: 04.04.2017
 * Time: 10:21
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use phpnt\bootstrapSelect\BootstrapSelectAsset;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model common\models\forms\AdsForm */
/* @var $form yii\widgets\ActiveForm */
/* @var $tariff \common\models\forms\AdsTariffForm */

?>

<div class="user-form-form">
    <?php
    Pjax::begin(['id' => 'pjaxModalTariff', 'enablePushState' => false]);
    BootstrapSelectAsset::register($this);
    ?>
    <?php $form = ActiveForm::begin([
        'id'    => 'form-tariff',
        'method'    => 'POST',
        'action' => Url::to(['/ya/index', 'id' => $model->id, 'tariff' => $model->tariff_id]),
        'options' => ['data-pjax' => false],
    ]); ?>

    <?= $form->field($model, 'tariff_id')->dropDownList($model->tariffList, [
        'class'     => 'form-control selectpicker',
        'data' => [
            'style' => 'btn-primary',
            'title' => $model->getAttributeLabel('tariff_id')
        ],
        'onchange' => '
            var id = $(this).val();
            $.pjax({
                type: "POST",
                url: "'.Url::to(['/users-car/set-tariff', 'id' => $model->id]).'",
                data: jQuery("#form-tariff").serialize(),
                container: "#pjaxModalTariff",
                push: false,
                scrollTo: false
            })'
    ]); ?>

    <div class="clearfix"></div>

    <?php
    /*d($data);*/
    ?>

    <div class="form-group text-center" style="margin-top: 30px;">
        <?php
        if (isset($tariff)):
        ?>
            <h3>Стоимость: <?= $tariff->price ?>.00 руб.</h3>
            <?= Html::hiddenInput('shopId', '132979') ?>
            <?= Html::hiddenInput('scid', '553250') ?>
            <?= Html::hiddenInput('customerNumber', Yii::$app->user->identity->email) ?>
            <?= Html::hiddenInput('sum', $tariff->price) ?>
            <?= Html::submitButton('Перейти на страницу оплаты', ['class' => 'btn btn-primary']) ?>
        <?php
        else:
        ?>
            <?= Html::submitButton('Перейти на страницу оплаты', ['class' => 'btn btn-primary disabled', 'disabled' => true]) ?>
        <?php
        endif;
        ?>
    </div>

    <?php ActiveForm::end(); ?>
    <?php
    Pjax::end();
    ?>
</div>

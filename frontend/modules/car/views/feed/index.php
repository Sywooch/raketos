<?php
/* @var $this yii\web\View */
/* @var $model \common\models\forms\AdsForm */

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use phpnt\bootstrapSelect\BootstrapSelectAsset;
use yii\helpers\Url;
use yii\widgets\Pjax;
use common\widgets\StepsNavigation\StepsNavigation;
?>

<div class="ads-feed-index">
    <div class="col-md-12">
        <?php
        echo StepsNavigation::widget([
            'targetStep1' => '#confirm-step1',
            'urlStep1' => Url::to(['index', 'id' => $model->id]),
            'urlStep2' => Url::to(['/#']),
            'urlStep3' => Url::to(['/#']),
            'titleStep1' => Yii::t('app', 'Шаг 1. Добавить автомобиль'),
            'titleStep2' => Yii::t('app', 'Шаг 2. Указать дополнительные параметры'),
            'titleStep3' => Yii::t('app', 'Шаг 3. Подать объявление'),
            'headerStep1' => Yii::t('app', 'Шаг 1. Добавить автомобиль'),
            'headerStep2' => Yii::t('app', 'Шаг 2. Указать дополнительные параметры'),
            'headerStep3' => Yii::t('app', 'Шаг 3. Подать объявление'),
            'contentStep1' => Yii::t('app', 'Выберите Ваш автомобиль'),
            'contentStep2' => Yii::t('app', 'Загрузите фото и укажите дополнительные параметры'),
            'contentStep3' => Yii::t('app', 'Ваше объявление добавлено!'),
            'classLinkStep1' => 'active',
            'classLinkStep2' => 'disabled',
            'classLinkStep3' => 'disabled',
            'classContentStep1' => 'tab-pane active',
            'classContentStep2' => 'tab-pane',
            'classContentStep3' => 'tab-pane',
        ]);
        ?>
    </div>
    <?php
    Pjax::begin([
        'id' => 'pjaxBlock',
        'enablePushState' => false,
    ]);
    BootstrapSelectAsset::register($this);
    ?>
    <?php $form = ActiveForm::begin([
        'id' => 'form',
        'action' => Url::to(['create', 'id' => $model->id]),
        'options' => ['data-pjax' => true]]); ?>

    <div class="col-md-12">
    <?= $form->field($model, 'id_car_mark')->dropDownList($model->markList, [
        'class'     => 'form-control selectpicker',
        //'disabled'  => true,
        'data' => [
            'style' => 'btn-primary',
            'live-search' => 'true',
            'size' => 10,
            'title' => $model->getAttributeLabel('id_car_mark')
        ],
        'onchange' => '
            var id = $(this).val();
            $.pjax({
                type: "POST",
                url: "'.Url::to(['/car/feed/select-mark?id=']).'" + id,
                data: jQuery("#form").serialize(),
                container: "#pjaxBlock",
                push: false,
                scrollTo: false
            })'
    ]); ?>
    </div>

    <div class="col-md-12">
    <?php
    if ($model->id_car_mark):
        ?>
        <?php
        $count = count($model->modelList);
        if ($count == 1):
            $model->id_car_model = $model->getKey($model->modelList);
            echo $form->field($model, 'id_car_model')->hiddenInput()->label(false);
            ?>
            <?php
        else:
            ?>
            <?= $form->field($model, 'id_car_model')->dropDownList($model->modelList, [
            'class'     => 'form-control selectpicker',
            //'disabled'  => $model->id_car_model ? true : false,
            'data' => [
                'style' => 'btn-primary',
                'live-search' => 'true',
                'size' => 10,
                'title' => $model->getAttributeLabel('id_car_model')
            ],
            'onchange' => '
            var id = $(this).val();
            $.pjax({
                type: "POST",
                url: "'.Url::to(['/car/feed/select-model?id=']).'" + id,
                data: jQuery("#form").serialize(),
                container: "#pjaxBlock",
                push: false,
                scrollTo: false
            })'
        ]); ?>
            <?php
        endif;
        ?>
        <?php
    endif;
    ?>
    </div>

    <div class="col-md-6">
        <?= $form->field($model, 'year')->dropDownList($model->yearList, [
            'class'     => 'form-control selectpicker',
            //'disabled'  => $model->id_car_model ? true : false,
            'data' => [
                'style' => 'btn-primary',
                'live-search' => 'true',
                'size' => 10,
                'title' => $model->getAttributeLabel('year')
            ],
        ]); ?>
    </div>

    <div class="col-md-6">
        <?= $form->field($model, 'mileage', ['template' => '{label}<div class="input-group">{input}
                            <span class="input-group-addon"><span class="glyphicon glyphicon-road"></span></span>
                         </div><i>{hint}</i>{error}'])
            ->textInput(['placeholder' => $model->getAttributeLabel('mileage')]) ?>
    </div>

    <?= $form->field($model, 'id')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'temp')->hiddenInput(['value' => 1])->label(false) ?>

    <?php
    /*d($model->id_car_model);*/
    if ($model->id_car_model):
        ?>
        <div class="form-group text-center">
            <?= Html::submitButton('Далее', ['class' => 'btn btn-warning']) ?>
        </div>
        <?php
    else:
        ?>
        <div class="form-group text-center">
            <?= Html::submitButton('Далее', ['class' => 'btn btn-warning', 'disabled' => true]) ?>
        </div>
        <?php
    endif;
    ?>

    <?php ActiveForm::end(); ?>
    <?php
    Pjax::end();
    ?>
</div>

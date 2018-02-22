<?php
/**
 * Created by PhpStorm.
 * User: Raketos - http://raketos.ru
 * Date: 19.03.2017
 * Time: 21:00
 */
/* @var $this yii\web\View */
/* @var $model \common\models\forms\AdsForm */
/* @var $user \common\models\extend\UserExtend */

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\helpers\Url;
use common\widgets\StepsNavigation\StepsNavigation;
use yii\bootstrap\Collapse;
use yii\bootstrap\Carousel;
use phpnt\animateCss\AnimateCssAsset;
use common\widgets\LightSlider\LightSliderAsset;

AnimateCssAsset::register($this);
LightSliderAsset::register($this);

$modification = $model->modification;
if (!$modification) {
    $modification = '';
} else {
    $modification = $model->modification->name;
}

$user = Yii::$app->user->identity;
/*$itemsSrc = $model->allImagesList;
$items = $model->getItemsCarousel($itemsSrc);*/
$itemsSrc = $model->allImagesList;
$items = $model->getItemsCarousel($itemsSrc);
?>

<div class="ads-feed-index">
    <div class="col-md-12">
        <?php
        echo StepsNavigation::widget([
            'targetStep1' => '#confirm-step1',
            'urlStep1' => Url::to(['step-one', 'id' => $model->id]),
            'urlStep2' => Url::to(['step-two', 'id' => $model->id]),
            'urlStep3' => Url::to(['/#']),
            'titleStep1' => Yii::t('app', 'Шаг 1. Добавить автомобиль'),
            'titleStep2' => Yii::t('app', 'Шаг 2. Указать дополнительные параметры'),
            'titleStep3' => Yii::t('app', 'Шаг 3. Подать объявление'),
            'headerStep1' => Yii::t('app', 'Шаг 1. Добавить автомобиль'),
            'headerStep2' => Yii::t('app', 'Шаг 2. Указать дополнительные параметры'),
            'headerStep3' => Yii::t('app', 'Шаг 3. Подать объявление'),
            'contentStep1' => Yii::t('app', 'Выберите Ваш автомобиль'),
            'contentStep2' => Yii::t('app', 'Загрузите фото и укажите дополнительные параметры'),
            'contentStep3' => Yii::t('app', 'Проверьте данные автомобиля и опубликуйте объявление'),
            'classLinkStep1' => '',
            'classLinkStep2' => '',
            'classLinkStep3' => 'active',
            'classContentStep1' => 'tab-pane',
            'classContentStep2' => 'tab-pane',
            'classContentStep3' => 'tab-pane active',
        ]);
        ?>
    </div>

    <div>
        <div class="col-md-12">
            <div class="row" style="padding: 10px;">
                <div class="col-md-12">
                    <span class="label label-warning" style="font-size: 14px;">Объявление №<?= $model->id ?> от <?= Yii::$app->formatter->asDate($model->created_at) ?></span>
                    <h1 style="margin-top: 15px; margin-bottom: 0;"><i class="fa fa-car" aria-hidden="true"></i>&nbsp;<?= $model->mark->name.' '.$model->model->name.' '.$modification ?></h1>
                    <h1 style="margin-top: 15px; padding-top: 0"><i class="fa fa-money" aria-hidden="true"></i>&nbsp;&nbsp;<?= $model->price ? $model->price.' <span class="rouble">o</span>' : 'Цена договорная' ?> </h1>
                    <h3 style="margin-top: 10px; margin-bottom: 0;" class="text-muted"><i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;<?= $model->cityAds->name_ru ?></h3>
                    <hr style="margin-top: 10px; margin-bottom: 10px;">
                </div>
                <div class="col-md-6">
                    <?php
                    if ($items):
                        ?>
                        <?= Carousel::widget([
                        'items' => $items,
                        'options' => [
                            'id' => 'myCarousel2',
                            'class' => '',
                            'style' => 'width:100%;',
                            'data-interval' => 'false'
                        ],
                        'controls' => [
                            '<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span><span class="sr-only">Previous</span>',
                            '<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span><span class="sr-only">Next</span>'
                        ],     // Стрелочки вперед - назад
                        'showIndicators' => true,                   // отображать индикаторы (кругляшки)
                    ]);
                        ?>
                        <ul id="autoWidth" class="cs-hidden light-slider" style="margin-top: 10px;">
                            <?php
                            $i = 1;
                            foreach ($itemsSrc as $itemSrc):
                                ?>
                                <li class="slide-<?= $i ?>"><?= Html::img($itemSrc, ['style' => 'width: 100%;']) ?></li>
                                <?php
                                $i++;
                            endforeach;
                            ?>
                            <!--<li class="slide-one"><?/*= Html::img('/img/auto01.jpg', ['style' => 'width: 100%;']) */?></li>
            <li class="slide-two"><?/*= Html::img('/img/auto01.jpg', ['style' => 'width: 100%;']) */?></li>
            <li class="slide-three"><?/*= Html::img('/img/auto01.jpg', ['style' => 'width: 100%;']) */?></li>
            <li class="slide-four"><?/*= Html::img('/img/auto01.jpg', ['style' => 'width: 100%;']) */?></li>-->
                        </ul>
                        <?php
                    else:
                        ?>
                        <?= Html::img(['/../img/nologo.png'], ['style' => 'width: 100%; border-bottom: 1px solid #000;']) ?>
                        <?php
                    endif;
                    ?>
                </div>
                <div class="col-md-4">
                    <h3><i class="fa fa-cog" aria-hidden="true"></i>&nbsp;&nbsp;Характеристики</h3>
                    <table class="table">
                        <tbody><tr>
                            <td class="text-muted"><?= $model->getAttributeLabel('year') ?></td>
                            <td><?= $model->year ? $model->year : 'Не указан' ?></td>
                        </tr>
                        <tr>
                            <td class="text-muted"><?= $model->getAttributeLabel('mileage') ?></td>
                            <td><?= $model->mileage ? $model->mileage : 'Не указан' ?></td>
                        </tr>
                        <?php
                        if ($model->serie):
                        ?>
                        <tr>
                            <td class="text-muted">Кузов</td>
                            <td><?= $model->serie->name ?></td>
                        </tr>
                        <?php
                        endif;
                        ?>
                        <tr>
                            <td class="text-muted"><?= $model->getAttributeLabel('color') ?></td>
                            <td><?= $model->color ? '<div style="background-color: '.$model->getColorIten($model->color).'">&nbsp;</div>' : 'Не указан' ?></td>
                        </tr>
                        <tr>
                            <td class="text-muted"><?= $model->adsCarCharacteristic->getAttributeLabel('engine_capacity') ?></td>
                            <td><?= $model->adsCarCharacteristic->engine_capacity ? $model->adsCarCharacteristic->engine_capacity : 'Не указан' ?></td>
                        </tr>
                        <tr>
                            <td class="text-muted"><?= $model->getAttributeLabel('engine_type') ?></td>
                            <td><?= $model->adsCarCharacteristic->engine_type ? $model->adsCarCharacteristic->engine_type : 'Не указан' ?></td>
                        </tr>
                        <tr>
                            <td class="text-muted"><?= $model->getAttributeLabel('gearbox_type') ?></td>
                            <td><?= $model->adsCarCharacteristic->gearbox_type ? $model->adsCarCharacteristic->gearbox_type : 'Не указан' ?></td>
                        </tr>
                        <tr>
                            <td class="text-muted"><?= $model->getAttributeLabel('drive_unit') ?></td>
                            <td><?= $model->adsCarCharacteristic->drive_unit ? $model->adsCarCharacteristic->drive_unit : 'Не указан' ?></td>
                        </tr>
                        <tr>
                            <td class="text-muted"><?= $model->getAttributeLabel('trunk_volume_max_from') ?></td>
                            <td><?= $model->adsCarCharacteristic->trunk_volume_max ? $model->adsCarCharacteristic->trunk_volume_max : 'Не указан' ?></td>
                        </tr>
                        <tr>
                            <td class="text-muted"><?= $model->getAttributeLabel('state') ?></td>
                            <td><?= $model->state ? $model->state : 'Не указано' ?></td>
                        </tr>
                        </tbody></table>
                </div>
                <div class="col-md-2">
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            <div class="panel-title text-center">Независимая оценка</div>
                        </div>
                        <div class="panel-body">
                            <h3 class="text-center"><?= round($model->ratingCalculate) ?>% из 100%</h3>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-6">
            <h3><i class="fa fa-comment" aria-hidden="true"></i>&nbsp;Комментарий продавца</h3>
            <div><?= $model->desc ? $model->desc : 'Не указан' ?></div>
        </div>
        <div class="col-md-4">
            <h3><i class="fa fa-address-card" aria-hidden="true"></i>&nbsp;
                Информация о продавце</h3>
            <ul class="list-group">
                <li class="list-group-item"><h4><i class="fa fa-user" aria-hidden="true"></i>&nbsp;&nbsp;
                        <?php
                        if ($profile_model) {
                            echo $profile_model->name;
                        }
                        else { ?>
                        
                            <?= $user->first_name ? $user->first_name : $user->email ?>
                            <?= $user->last_name ? $user->last_name : '' ?>
                            <?= $user->middle_name ? $user->middle_name : '' ?>
                            
                      <?php   }    ?>                                               
                       

                    </h4>
                </li>
                <li class="list-group-item"><h4><i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;&nbsp;
                        <?= $model->cityAds->name_ru ?></h4></li>
                <li class="list-group-item"><h4><i class="fa fa-mobile" aria-hidden="true"></i>&nbsp;&nbsp;
                        
                          <?php
                        if ($profile_model) {
                            echo $profile_model->phone;
                        }
                        else { ?>
                        
                       <?= $user->phone ?>
                            
                      <?php   }    ?> 
                        
                        </h4></li>

            </ul>
        </div>
        <div class="clearfix"></div>
        <?php
        if ($model->modification):
        ?>
        <div class="col-md-12">
            <?= Collapse::widget([
                'encodeLabels' => false,
                'items' => [
                    [
                        'label' => '<h1 class="text-center">Все характеристики</h1>',
                        'content' => $this->render('_all-info', ['model' => $model]),
                        // open its content by default
                        'contentOptions' => ['class' => Yii::$app->request->get('extend-search') ? 'in' : '']
                    ],
                ]
            ]); ?>
        </div>
        <?php
        endif;
        ?>
        <div class="col-md-12" style="margin-top: 40px;">
            <?php $form = ActiveForm::begin([
                'id' => 'form',
                'action' => Url::to(['step-three', 'id' => $model->id]),
                'options' => ['data-pjax' => true]]); ?>

            <?= $form->field($model, 'temp')->hiddenInput(['value' => 0])->label(false) ?>

            <div class="form-group text-center">
                <?= Html::submitButton('Опубликовать', ['class' => 'btn btn-warning']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<?php
$js = <<< JS
$(document).ready(function(){
    $('#myCarousel2').carousel({ interval: false });
  $(".slide-1").click(function(){
    $("#myCarousel2").carousel(0);
  });
  // Осуществляет переход на 1 слайд карусели 
  $(".slide-2").click(function(){
    $("#myCarousel2").carousel(1);
  });
  // Осуществляет переход на 2 слайд карусели 
  $(".slide-3").click(function(){
    $("#myCarousel2").carousel(2);
  });
  $(".slide-4").click(function(){
    $("#myCarousel2").carousel(3);
  });
});
JS;
$this->registerJs($js);
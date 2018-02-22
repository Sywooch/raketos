<?php
/**
 * Created by PhpStorm.
 * User: Raketos - http://raketos.ru
 * Date: 09.09.2016
 * Time: 14:13
 */
use common\widgets\RangeSlider\RangeSliderAsset;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\bootstrap\Html;

/* @var $this yii\web\View */

RangeSliderAsset::register($this)
?>
<article class="find-auto" id="find-auto">
    <div class="container" style="padding-top: 100px;">
        <div class="row">
            <div class="col-md-12">
                    <h1 style="font-size: 32px; font-weight 500; margin-top: 80px; margin-bottom: 20px;">Найди свой автомобиль</h1>
                    <h3 style="color: #e0e0e0; padding-top: 0; opacity: 0.5;">со скоростью света</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-3">
                <?= Html::a('<img src="/img/button-les.png" alt="Автомобиль для леса и дачи" class="animated img-responsive center-block" style="width: 80%;">
                    <span> Для леса и дачи </span>', Url::to(['/users-car/search', 'AdsSearch' => ['type' => 'forest']]),['class' => 'white-link']) ?>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-3">
                <?= Html::a('<img src="/img/button-gorod.png" alt="Для города" class="animated img-responsive center-block" style="width: 80%;">
                    <span> Для города </span>', Url::to(['/users-car/search', 'AdsSearch' => ['type' => 'city']]),['class' => 'white-link']) ?>
            </div>
            <div class="visible-sm" style="margin-bottom: 40px;">&nbsp;</div>
            <div class="visible-xs" style="margin-bottom: 40px;">&nbsp;</div>

            <div class="col-xs-6 col-sm-6 col-md-3">
                <?= Html::a('<img src="/img/button-semya.png" alt="Для семьи" class="animated img-responsive center-block" style="width: 80%;">
                    <span> Для семьи </span>', Url::to(['/users-car/search', 'AdsSearch' => ['type' => 'family']]),['class' => 'white-link']) ?>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-3">
                <?= Html::a('<img src="/img/button-poezdki.png" alt="Для дальних поездок" class="animated img-responsive center-block" style="width: 80%;">
                    <span> Для дальних поездок </span>', Url::to(['/users-car/search', 'AdsSearch' => ['type' => 'travel']]),['class' => 'white-link']) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <section class="price-slider-title">
                    <div> Цена автомобиля </div>
                </section>

                <section class="price-slider" style="width: 75% !important; margin: 0 auto !important;">
                    <?php $form = ActiveForm::begin([
                        'id' => 'form',
                        'action' => Url::to(['/users-car/search']),
                        'method' => 'get',
                        'options' => ['data-pjax' => true]]); ?>
                        <input type="text" id="range" value="" name="range" class="irs-hidden-input" min="1000" max="5000000" from="200000" to="1000000" style="display: none;">
                    <div class="clearfix"></div>
                    <?= Html::submitButton('Найти', ['class' => 'btn btn-raketos', 'style' => 'margin-top: 60px;']) ?>
                    <?php ActiveForm::end(); ?>
                </section>

                <!--<a class="btn btn-raketos" href="autos.html">Найти</a>-->
                <section class="advanced-search"><?= Html::a('Расширенный поиск', Url::to(['/users-car/search', 'extend-search' => '1']), ['class' => 'dot']) ?></section>
            </div>
        </div>
    </div>
</article>
<?php
$js = <<<SCRIPT
$( "#range" ).change(function() {
    if($( ".irs-to" ).text() == '5 000 000') {
        $(".irs-to").text("5 000 000+");
    }
});

SCRIPT;
$this->registerJs($js);
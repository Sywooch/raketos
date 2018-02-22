<?php

use yii\bootstrap\Html;
use yii\widgets\ListView;
use yii\helpers\Url;
use common\widgets\MainCarousel\MainCarousel;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\AdsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModelPaid common\models\search\AdsSearch */
/* @var $dataProviderPaid yii\data\ActiveDataProvider */
/* @var $marks \common\models\extend\AdsExtend[] */

$this->title = Yii::$app->name;
?>
<?= MainCarousel::widget() ?>
<article class="quick-links" style="border-bottom: 1px solid #ccc;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <section class="quick-links-buttons">
                    <?= Html::a('новые до 400 тыс.', Url::to(['/users-car/search',
                        'AdsSearch' => ['price_from' => 400000, 'mileage_to' => 1]]),
                        ['class' => 'btn btn-default btn-sm']) ?>
                    <?= Html::a('с пробегом от 250 тыс.', Url::to(['/users-car/search',
                        'AdsSearch' => ['mileage_from' => 250000]]),
                        ['class' => 'btn btn-default btn-sm']) ?>
                    <?= Html::a('на дизеле от 500 тыс.', Url::to(['/users-car/search',
                        'AdsSearch' => ['fuel_grade' => 'ДТ', 'price_from' => 500000]]),
                        ['class' => 'btn btn-default btn-sm']) ?>
                    <?= Html::a('Лада XRAY', Url::to(['/users-car/search',
                        'AdsSearch' => ['id_car_model' => 19210]]),
                        ['class' => 'btn btn-default btn-sm']) ?>
                    <?= Html::a('авто от 200 л.с.', Url::to(['/users-car/search',
                        'AdsSearch' => ['power_from' => 200]]),
                        ['class' => 'btn btn-default btn-sm']) ?>
                    <?= Html::a('с пробегом с 2011 г.', Url::to(['/users-car/search',
                        'AdsSearch' => ['year_from' => 2011, 'mileage_from' => 1]]),
                        ['class' => 'btn btn-default btn-sm']) ?>
                    <?= Html::a('пробег до 50 000 км.', Url::to(['/users-car/search',
                        'AdsSearch' => ['mileage_to' => 50000]]),
                        ['class' => 'btn btn-default btn-sm']) ?>
                </section>
            </div>
        </div>
    </div>
</article>
<div class="site-index">
    <div class="container" style="margin-top: 40px;">
        <div class="col-md-12" style="margin-bottom: 60px;">
            <div class="col-md-12 text-center">
                <h1>Платные объявления</h1>
            </div>
            <?php /*echo $this->render('_search', ['model' => $searchModel]); */?>
            <?= ListView::widget([
                'dataProvider' => $dataProviderPaid,
                'id' => 'my-listview-id',
                'summary'=>'',
                'pager' => [
                    // Customzing options for pager container tag
                    'options' => [
                        //'tag' => 'div',
                        'class' => 'col-md-12 pagination text-center',
                        'style' => 'padding-left: 25px;',
                    ],
                ],
                'itemView' => function ($model, $key, $index, $widget) {
                    /* $var $model AdsExtend */
                    return $this->render('_item-paid' ,[
                        'model' => $model,
                        'key' => $key,
                        'index' => $index,
                        'widget' => $widget
                    ]);
                },
            ]); ?>
        </div>
    </div>
</div>
<article class="popular-brands" style="background-color: #f5f5f5;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <section>
                    <h2>Популярные марки</h2>
                    <div class="row">
                        <?php
                        foreach ($marks as $mark):
                            /* @var $mark \common\models\extend\AdsExtend */
                            ?>
                            <div class="col-sm-6 col-md-3" style="margin: 0; padding: 0;">
                                <div class="list-group " style="margin: 0; padding: 0;">
                                    <?php
                                    if (isset($mark->mark->name)):
                                        ?>
                                        <?= Html::a($mark->mark->name.' <span class="brand-count">'.$mark->getCountMark().'</span>',
                                        Url::to(['/users-car/index', 'AdsSearch' => ['id_car_mark' => [$mark->id_car_mark]]]), ['class' => 'list-group-item mark-item']) ?>
                                        <?php
                                    endif;
                                    ?>
                                </div>
                            </div>
                            <?php
                        endforeach;
                        ?>
                        <div class="col-md-12 text-center" style="margin-top: 40px;">
                            <?= Html::a('показать все марки',
                                Url::to(['/users-car/index']), ['class' => 'btn btn-default']) ?>
                        </div>
                        <br><br>
                    </div>
                </section>
            </div>
        </div>
    </div>
</article>
<div class="clearfix"></div>
<div class="site-index">
    <div class="container" style="margin-top: 40px;">
        <div class="col-md-12" style="margin-bottom: 60px;">
            <div class="col-md-12 text-center">
                <h1>Самое свежее</h1>
            </div>
            <?php /*echo $this->render('_search', ['model' => $searchModel]); */?>
            <?= ListView::widget([
                'dataProvider' => $dataProvider,
                'id' => 'my-listview-id',
                'summary'=>'',
                'pager' => [
                    // Customzing options for pager container tag
                    'options' => [
                        //'tag' => 'div',
                        'class' => 'col-md-12 pagination text-center',
                        'style' => 'padding-left: 25px;',
                    ],
                ],
                'itemView' => function ($model, $key, $index, $widget) {
                    /* $var $model AdsExtend */
                    return $this->render('_item' ,[
                        'model' => $model,
                        'key' => $key,
                        'index' => $index,
                        'widget' => $widget
                    ]);
                },
            ]); ?>
        </div>
    </div>
</div>
<?php
$js = <<<JS
var docElem = document.documentElement,
        headerTop = document.querySelector( '.navbar-default' ),
        header = document.querySelector( '.navbar-default' ),
        didScroll = false,
        changeHeaderOn = 20;
function init() {
        window.addEventListener( 'scroll', function( event ) {
            if( !didScroll ) {
                didScroll = true;
                setTimeout( scrollPage, 20 );
            }
        }, false );
    }
function scrollPage() {
        var sy = scrollY();
        if ( sy >= changeHeaderOn ) {
            $('.navbar-wrapper').removeClass('hidden');
            $('.top-header-navbar').removeClass('hidden');
        }
        else {
            $('.navbar-wrapper').removeClass('hidden');
            $('.top-header-navbar').removeClass('hidden');
        }
        didScroll = false;
    }
    function scrollY() {
        return window.pageYOffset || docElem.scrollTop;
    }
    init();
JS;
$this->registerJs($js);

?>
<style>
    .pagination {
        display: none !important;
    }
</style>

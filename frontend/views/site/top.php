<?php
/**
 * Created by PhpStorm.
 * User: Raketos - http://raketos.ru
 * Date: 09.02.2017
 * Time: 11:12
 */

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\AdsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Топ 100';
?>

<div class="col-md-12 text-center">
    <h1><?= $this->title ?></h1>
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
            'style' => '',
        ],
    ],
    'options' => [
            'class' => 'carousel-slick'
    ],
    'itemView' => function ($model, $key, $index, $widget) {
        /* $var $model AdsExtend */
        return $this->render('_item_slick' ,[
            'model' => $model,
            'key' => $key,
            'index' => $index,
            'widget' => $widget
        ]);
    },
]); ?>
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

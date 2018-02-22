<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\helpers\Url;
use yii\bootstrap\Collapse;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\AdsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $marks \common\models\extend\AdsExtend[] */

$this->title = 'Объявления';
$this->params['breadcrumbs'][] = $this->title;

$filter = Yii::$app->request->get('AdsSearch');
//dd($filter);
if (!$filter) {
    $filter = [];
}
?>
<div class="ads-form-index" style="margin-top: 80px;">

    <?php /*echo $this->render('_search', ['model' => $searchModel]); */?>

    <?php
    if (Yii::$app->controller->action->id == 'search'):
        ?>
        <?= Collapse::widget([
        'encodeLabels' => false,
        'items' => [
            [
                'label' => '<h1 class="text-center">Расширенный поиск <span style="float: right" class="glyphicon glyphicon-filter"></span></h1>',
                'content' => $this->render('_search', ['model' => $searchModel]),
                // open its content by default
                'contentOptions' => ['class' => Yii::$app->request->get('extend-search') ? 'in' : '']
            ],
        ]
    ]); ?>
        <?php
    else:
        ?>
        <article class="popular-brands" style="background-color: #f5f5f5; padding-top: 0;">
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
                                                Url::to(['/users-car/index', 'AdsSearch' => ['id_car_mark' => $mark->id_car_mark]]), ['class' => 'list-group-item mark-item']) ?>
                                                <?php
                                            endif;
                                            ?>
                                        </div>
                                    </div>
                                    <?php
                                endforeach;
                                ?>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </article>
        <?php
    endif;
    ?>

    <div class="col-sm-12 text-center" style="margin: 30px 0 40px 0;">
        <div class="btn-group btn-group-sm" role="group">
            <?php
            $sort = Yii::$app->request->get('sort');
            ?>
            <?php
            if ($sort == 'rating'):
                ?>
                <?= Html::a('<i class="fa fa-sort-asc" aria-hidden="true"></i>&nbsp;&nbsp;по рейтингу',
                Url::to(['users-car/search', 'AdsSearch' => $filter, 'sort' => '-rating']),
                [
                    'class' => 'btn btn-default active'
                ]) ?>
                <?php
            elseif ($sort == '-rating'):
                ?>
                <?= Html::a('<i class="fa fa-sort-desc" aria-hidden="true"></i>&nbsp;&nbsp;по рейтингу',
                Url::to(['users-car/search', 'AdsSearch' => $filter, 'sort' => 'rating']),
                [
                    'class' => 'btn btn-default active'
                ]) ?>
                <?php
            else:
                ?>
                <?= Html::a('<i class="fa fa-sort" aria-hidden="true"></i>&nbsp;&nbsp;по рейтингу',
                Url::to(['users-car/search', 'AdsSearch' => $filter, 'sort' => '-rating']),
                [
                    'class' => 'btn btn-default'
                ]) ?>
                <?php
            endif;
            ?>

            <?php
            if ($sort == 'price'):
                ?>
                <?= Html::a('<i class="fa fa-sort-asc" aria-hidden="true"></i>&nbsp;&nbsp;по цене',
                Url::to(['users-car/search', 'AdsSearch' => $filter, 'sort' => '-price']),
                [
                    'class' => 'btn btn-default active'
                ]) ?>
                <?php
            elseif ($sort == '-price'):
                ?>
                <?= Html::a('<i class="fa fa-sort-desc" aria-hidden="true"></i>&nbsp;&nbsp;по цене',
                Url::to(['users-car/search', 'AdsSearch' => $filter, 'sort' => 'price']),
                [
                    'class' => 'btn btn-default active'
                ]) ?>
                <?php
            else:
                ?>
                <?= Html::a('<i class="fa fa-sort" aria-hidden="true"></i>&nbsp;&nbsp;по цене',
                Url::to(['users-car/search', 'AdsSearch' => $filter, 'sort' => 'price']),
                [
                    'class' => 'btn btn-default'
                ]) ?>
                <?php
            endif;
            ?>

            <?php
            if ($sort == 'year'):
                ?>
                <?= Html::a('<i class="fa fa-sort-asc" aria-hidden="true"></i>&nbsp;&nbsp;по году',
                Url::to(['users-car/search', 'AdsSearch' => $filter, 'sort' => '-year']),
                [
                    'class' => 'btn btn-default active'
                ]) ?>
                <?php
            elseif ($sort == '-year'):
                ?>
                <?= Html::a('<i class="fa fa-sort-desc" aria-hidden="true"></i>&nbsp;&nbsp;по году',
                Url::to(['users-car/search', 'AdsSearch' => $filter, 'sort' => 'year']),
                [
                    'class' => 'btn btn-default active'
                ]) ?>
                <?php
            else:
                ?>
                <?= Html::a('<i class="fa fa-sort" aria-hidden="true"></i>&nbsp;&nbsp;по году',
                Url::to(['users-car/search', 'AdsSearch' => $filter, 'sort' => 'year']),
                [
                    'class' => 'btn btn-default'
                ]) ?>
                <?php
            endif;
            ?>

            <?php
            if ($sort == 'mileage'):
                ?>
                <?= Html::a('<i class="fa fa-sort-asc" aria-hidden="true"></i>&nbsp;&nbsp;по пробегу',
                Url::to(['users-car/search', 'AdsSearch' => $filter, 'sort' => '-mileage']),
                [
                    'class' => 'btn btn-default active'
                ]) ?>
                <?php
            elseif ($sort == '-mileage'):
                ?>
                <?= Html::a('<i class="fa fa-sort-desc" aria-hidden="true"></i>&nbsp;&nbsp;по пробегу',
                Url::to(['users-car/search', 'AdsSearch' => $filter, 'sort' => 'mileage']),
                [
                    'class' => 'btn btn-default active'
                ]) ?>
                <?php
            else:
                ?>
                <?= Html::a('<i class="fa fa-sort" aria-hidden="true"></i>&nbsp;&nbsp;по пробегу',
                Url::to(['users-car/search', 'AdsSearch' => $filter, 'sort' => 'mileage']),
                [
                    'class' => 'btn btn-default'
                ]) ?>
                <?php
            endif;
            ?>
            <?php
            if ($sort == 'created_at'):
                ?>
                <?= Html::a('<i class="fa fa-sort-asc" aria-hidden="true"></i>&nbsp;&nbsp;по дате',
                Url::to(['users-car/search', 'AdsSearch' => $filter, 'sort' => '-created_at']),
                [
                    'class' => 'btn btn-default active'
                ]) ?>
                <?php
            elseif ($sort == '-created_at'):
                ?>
                <?= Html::a('<i class="fa fa-sort-desc" aria-hidden="true"></i>&nbsp;&nbsp;по дате',
                Url::to(['users-car/search', 'AdsSearch' => $filter, 'sort' => 'created_at']),
                [
                    'class' => 'btn btn-default active'
                ]) ?>
                <?php
            else:
                ?>
                <?= Html::a('<i class="fa fa-sort" aria-hidden="true"></i>&nbsp;&nbsp;по дате',
                Url::to(['users-car/search', 'AdsSearch' => $filter, 'sort' => 'created_at']),
                [
                    'class' => 'btn btn-default'
                ]) ?>
                <?php
            endif;
            ?>
        </div>
    </div>
    <div style="text-align: center !important;"></div>
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
            //print_r($index);
            return $this->render('_item' ,[
                'model' => $model,
                'key' => $key,
                'index' => $index,
                'widget' => $widget
            ]);
        },
    ]); ?>
</div>
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
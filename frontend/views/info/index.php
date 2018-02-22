<?php
/**
 * Created by PhpStorm.
 * User: Raketos - http://raketos.ru
 * Date: 09.02.2017
 * Time: 11:19
 */
use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $searchModel \common\models\search\InfoSearch */
/* @var $model \common\models\extend\InfoExtend */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $model->name;
?>
<div class="col-md-12">
    <h1><?= $this->title ?></h1>
</div>
<div class="col-md-12">
    <?= $model->text ?>
</div>
<div class="col-md-12">
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'id' => 'my-listview-id',
        'summary'=>'',
        'itemView' => function ($model, $key, $index, $widget) {
            /* $var $model Company */
            return $this->render('_item' ,[
                'model' => $model,
                'key' => $key,
                'index' => $index,
                'widget' => $widget
            ]);
        },
    ]);
    ?>
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
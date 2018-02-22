<?php
use phpnt\chartJS\ChartJs;
use yii\bootstrap\Collapse;

/* @var $this yii\web\View */

$this->title = Yii::t('app', 'Главная');
?>
<div class="col-lg-12">
    <div class="ibox float-e-margins">
        <div class="ibox-content text-center p-md">
            <h2><span class="text-navy">Статистика <strong>«Каталога автомобильных объявлений для «Бавария-Авто».</strong></span></h2>
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="ibox">
        <div class="ibox-content">
            <?= Collapse::widget([
                'items' => [
                    [
                        'label' => 'О данном разделе',
                        'content' => 'В данном разделе предполагается вывод графиков, информации и общей статистики по сайту. ',
                    ],
                ]]); ?>
        </div>
    </div>
</div>

<div class="col-md-4" style="margin-bottom: 60px;">
    <div class="ibox float-e-margins">
        <div class="ibox-content text-center p-md">
            <?= ChartJs::widget([
                'type'  => ChartJs::TYPE_DOUGHNUT,
                'data'  => \common\models\extend\UserOnlineExtend::getStatisticOnlineUsers(),
                'options'   => [
                    'segmentStrokeColor' => "#fff",
                    'segmentStrokeWidth' => 2,
                    'percentageInnerCutout' => 45, // This is 0 for Pie charts
                    'animationSteps' => 100,
                    'animationEasing' => "easeOutBounce",
                ]
            ]) ?>
        </div>
    </div>
</div>

<?php
/**
 * Created by PhpStorm.
 * User: Raketos
 * Date: 28.05.2016
 * Time: 22:18
 */
use yii\bootstrap\Modal;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $widget \common\widgets\SelectCity\SelectCity */
/* @var $model \common\models\forms\SelectCityForm */
?>
<span class="map-marker">
    <?= Html::a($widget->city_name, ['#'],
        [
            'data-toggle' => 'modal',
            'data-target' => '#selectCityModal',
            'style' => 'outline: none; ',
        ]) ?>

</span>
<?php
Modal::begin([
    'id' => 'selectCityModal',
    'header' => '<h2 class="text-center">Выберите город</h2>',
    'toggleButton' => false,
]);
?>
<div class="row" style="padding-left: 15px; padding-right: 15px;">
    <?= $this->render('@frontend/views/site/_select-city', ['model' => $widget->model]) ?>
</div>
<?php
Modal::end();
?>


<?php
/**
 * Created by PhpStorm.
 * User: Raketos - http://raketos.ru
 * Date: 24.04.2017
 * Time: 13:53
 */

/* @var $this yii\web\View */
/* @var $model \common\models\extend\AdsExtend */
/* @var $key integer */
/* @var $index integer */

use yii\bootstrap\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use phpnt\bootstrapNotify\BootstrapNotify;
?>
<div class="col-md-3 col-sm-6" style="margin-top: 30px;">
    <a class="item-card-link" href="<?= Url::to(['/users-car/view', 'id' => $model->id]) ?>" data-pjax="false">
        <?php Pjax::begin([
            'id' => 'item-'.$key,
            'enablePushState' => false,
        ]); ?>
        <?= BootstrapNotify::widget() ?>
        <div class="item-card">
            <div class="row">
                <div class="col-xs-12" style="">
                    <?php
                    if ($model->imagesMain):
                        ?>
                        <?php
                        foreach ($model->imagesMain as $item):
                            /* @var $item \phpnt\cropper\models\Photo */
                            ?>
                            <?= Html::img(['/../'.$item->file_small], ['style' => 'width: 100%; border-bottom: 1px solid #000;']) ?>
                            <?php
                        endforeach;
                        ?>
                        <?php
                    else:
                        ?>
                        <?= Html::img(['/../img/nologo.png'], ['style' => 'width: 100%; border-bottom: 1px solid #000;']) ?>
                        <?php
                    endif;
                    ?>
                </div>
                <div class="col-xs-12 text-center">
                    <div class="item-card-header">
                        <h3 style="font-weight: 500"><?= $model->mark->name ?></h3>
                        <h2 style="font-weight: 500"><?= $model->model->name ?></h2>
                        <?php
                        if ($model->price):
                            ?>
                            <h3 style="font-weight: 500"><?= $model->price ?> <span class="glyphicon glyphicon-rub"></span></h3>
                            <?php
                        else:
                            ?>
                            <h3 style="font-weight: 500">Цена договорная</h3>
                            <?php
                        endif;
                        ?>
                        <h3 style="font-weight: 500"><?= $model->cityAds->name_ru ?></h3>
                        <h3 style="font-weight: 500;"><span style="color: red;" class="glyphicon glyphicon-heart"></span> <?= $model->rating ? $model->rating : 0 ?></h3>
                        <?= Html::a('Редактировать', Url::to(['/car/feed/step-two', 'id' => $model->id]), ['class' => 'btn btn-xs btn-success']) ?><br>
                        <?= Html::a('Удалить', Url::to(['/profile/delete', 'id' => $model->id]), [
                                'class' => 'btn btn-xs btn-danger',
                            'onclick' => 'if (confirm("Удалить объявление?")){} else {return false;}',
                            'style' => 'margin-top: 5px;'
                        ]) ?>
                    </div>
                </div>
            </div>
        </div>
        <?php Pjax::end(); ?>
    </a>
</div>


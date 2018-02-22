<?php
/**
 * Created by PhpStorm.
 * User: Raketos - http://raketos.ru
 * Date: 28.03.2017
 * Time: 17:28
 */

use yii\bootstrap\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use phpnt\bootstrapNotify\BootstrapNotify;
use frontend\assets\SlickAsset;
use common\widgets\SlickCarousel\SlickCarouselAsset;

/* @var $this yii\web\View */
?>
<?php Pjax::begin([
    'id' => 'item-'.$key,
    'enablePushState' => false,
]); ?>
    <div>
        <?php
        SlickCarouselAsset::register($this);
        SlickAsset::register($this);
        ?>
        <?= BootstrapNotify::widget() ?>
        <div class="item-card">
            <div class="row">
                    <h3 class="text-center" style="margin-top: 15px;"><?= 'Место '.($index+1) ?></h3>
                <div class="">
                    <?php
                    if ($model->imagesMain):
                        ?>
                        <?php
                        foreach ($model->imagesMain as $item):
                            /* @var $item \phpnt\cropper\models\Photo */
                            ?>
                            <?= Html::img(['/../'.$item->file_small], ['style' => 'width: 90%; border-bottom: 0px solid #000;']) ?>
                            <?php
                        endforeach;
                        ?>
                        <?php
                    else:
                        ?>
                        <?= Html::img(['/../img/nologo.png'], ['style' => 'width: 90%; border-bottom: 1px solid #000;']) ?>
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
                            <h3 style="font-weight: 500"><?= $model->price ?> <i class="glyphicon glyphicon-rub"></i></h3>
                            <?php
                        else:
                            ?>
                            <h3 style="font-weight: 500">Цена договорная</h3>
                            <?php
                        endif;
                        ?>
                        <h4 style="font-weight: 500"><?= $model->year ?>/<?= $model->mileage ?> км</h4>
                        <h3 style="font-weight: 500"><?= $model->cityAds->name_ru ?></h3>
                        <h3 style="font-weight: 500;"><i style="color: red;" class="glyphicon glyphicon-heart"></i> <?= $model->rating ? $model->rating : 0 ?></h3>
                        <div class="text-center">
                            <?php
                            if (!Yii::$app->user->isGuest):
                                if (Yii::$app->user->can('authorRule', $model)):
                                    ?>
                                    <?= Html::a('Редактировать', Url::to(['/car/feed/step-two', 'id' => $model->id]),
                                    ['class' => 'btn btn-xs btn-success', 'style' => 'display: none;']) ?>
                                    <?php
                                else:
                                    ?>
                                    <?php
                                    if ($model->ratingAds):
                                        ?>
                                        <?= Html::a('Не нравится', Url::to(['/site/dislike-slick', 'id' => $model->id, 'index' => $index]),
                                        ['class' => 'btn btn-xs btn-danger', 'style' => 'display: none;']) ?>
                                        <?php
                                    else:
                                        ?>
                                        <?= Html::a('Нравится', Url::to(['/site/like-slick', 'id' => $model->id, 'index' => $index]),
                                        ['class' => 'btn btn-xs btn-danger', 'style' => 'display: none;']) ?>
                                        <?php
                                    endif;
                                    ?>
                                    <?php
                                endif;
                            else:
                                ?>
                                <?= Html::button('Нравится', ['class' => 'btn btn-xs btn-danger', 'disabled' => true]) ?>
                                <?php
                            endif;
                            ?>
                            <div style="margin: 10px 0 10px 0;">
                            <?= Html::a('Просмотр', Url::to(['/users-car/view', 'id' => $model->id]), ['class' => 'btn btn-xs btn-warning', 'data-pjax' => '0', 'target' => '_blank']) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php Pjax::end(); ?>
<?php
/**
 * Created by PhpStorm.
 * User: Raketos - http://raketos.ru
 * Date: 16.06.2016
 * Time: 18:54
 */

use yii\bootstrap\Html;
use yii\helpers\Url;

/* @var $model \common\models\forms\QuestionForm */

$user = \common\models\extend\UserExtend::findOne($model->user->id);
$images = '';
$i = 1;
foreach($user->imagesMain as $one):
    /* @var $one \phpnt\cropper\models\Photo */

    if($i == 1) {
        $images .= Html::img(\Yii::$app->params['frontendUrl'].'/'.$one->file_small,
            [
                'width' => '40px',
                'style' => 'margin: 1px;',
                'class' => 'img-circle'
            ]);
    } else {
        break;
    }
    $i++;
endforeach;
if(!$images){
    $images = Html::img('/img/no-avatar.png',
        [
            'width' => '40px',
            'style' => 'margin: 1px;',
            'class' => 'img-circle'
        ]);
}
?>
<div class="clearfix"></div>
<div class="row">
    <div class="col-md-12">
        <h3 style="border-bottom: 1px dotted #fcc800; margin-top: 0;"><?= $images ?> <strong>Вопрос:</strong> <?= $model->question ?>
            <div style="float: right; font-size: 10px; padding-top: 15px;"><?= Yii::$app->formatter->asDate($model->created_at) ?></div></h3>
    </div>
    <div class="col-md-12" style="padding-left: 80px;">
        <h3 style="border-bottom: 1px dotted #fcc800; margin-top: 0;"><?= Html::img('/img/admin.png',
                [
                    'width' => '40px',
                    'style' => 'margin: 1px;',
                    'class' => 'img-circle'
                ]);?> <strong>Ответ:</strong> <?= $model->answer ?>
            <div style="float: right; font-size: 10px; padding-top: 15px;"><?= Yii::$app->formatter->asDate($model->updated_at) ?></div></h3>
    </div>
    <div class="clearfix"></div>
    <div class="single-line" style="margin-top: 5px; margin-bottom: 15px; "></div>
</div>

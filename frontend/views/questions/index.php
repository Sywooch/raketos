<?php
/**
 * Created by PhpStorm.
 * User: Raketos - http://raketos.ru
 * Date: 09.02.2017
 * Time: 11:19
 */
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\bootstrap\Modal;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

/* @var $searchModel \common\models\search\ArticleSearch */
/* @var $model \common\models\extend\ArticleExtend */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $modelQuestion \common\models\forms\QuestionForm */

$this->title = $model->name;
?>
<div class="col-md-12">
    <h1><?= $this->title ?></h1>
</div>
<div class="col-md-12">
    <?= $model->text ?>
</div>
<div class="col-md-12">
    <?php
    if (!Yii::$app->user->isGuest):
    ?>
        <?= Html::a('<i class="fa fa-question-circle" aria-hidden="true" style="margin-right: 5px;"></i> Задать вопрос', ['#'],
        [
            'class' => 'btn btn-primary',
            'data-toggle' => 'modal',
            'data-target' => '#questionModal',
            'style' => 'outline: none; margin-top: 30px;',
        ]) ?>
        <?php
        Modal::begin([
            'id' => 'questionModal',
            'header' => '<h2 class="text-center">Задать вопрос</h2>',
            'toggleButton' => false,
        ]);
        ?>
        <?php $form = ActiveForm::begin([
        'id' => 'form',
        'action' => Url::to(['/questions/create']),
        'options' => ['data-pjax' => true]]); ?>
        <div class="row">

            <div class="col-md-12">
                <?= $form->field($modelQuestion, 'question')->textarea(['placeholder' => $modelQuestion->getAttributeLabel('question'), 'style' => 'resize: vertical;']) ?>
            </div>

            <div class="col-md-12 text-center">
                <div class="form-group">
                    <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
                </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
        <?php
        Modal::end();
        ?>
    <?php
    endif;
    ?>
</div>
<div class="col-md-12" style="margin-top: 40px;">
    <div class="row">
        <div class="single-line" style="margin-top: 5px; margin-bottom: 15px; "></div>
    </div>
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
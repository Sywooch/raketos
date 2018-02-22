<?php
/**
 * Created by PhpStorm.
 * User: Raketos - http://raketos.ru
 * Date: 10.02.2017
 * Time: 18:00
 */
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model \common\models\forms\QuestionForm */
?>
<h1><?= Yii::$app->name ?></h1>
<p>Здравствуйте, получен ответ на ваш вопрос:<br>
    <strong style="padding-left: 40px;"><?= $model->question ?></strong>
</p>
<p>Ответ:<br>
    <strong style="padding-left: 40px;"><?= $model->answer ?></strong>
</p>
<p>Посмотреть ответы, на другие вопросы пользователей можно перейдя по <?= Html::a('этой ссылке', Url::to('http://raketos.ru/questions')) ?>
</p>
<p>
    Спасибо за обращение.<br>
    С Уважением администрация сайта <strong><?= Yii::$app->name ?></strong>.
</p>
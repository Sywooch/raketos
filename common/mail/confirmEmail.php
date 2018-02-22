<?php
/**
 * Created by PhpStorm.
 * User: Raketos - http://raketos.ru
 * Date: 04.07.2016
 * Time: 11:32
 */
use yii\helpers\Html;
use common\models\Identity;

/* @var $this yii\web\View */
/* @var $user \common\models\Identity */
?>
<h1><?= Yii::$app->name ?></h1>
<p><?= Yii::t('app', 'Ваш логин'). ':  '. $user->email ?></p>
<p><?= Yii::t('app', 'Ваш пароль'). ':  '. \common\models\extend\UserExtend::decript($user->password_encrypted) ?></p>
<?= Html::a(Yii::t('app', 'Для активации вашего аккаунта перейдите по этой ссылке.'),
    Yii::$app->urlManager->createAbsoluteUrl(
        [
            '/site/activate-account',
            'key' => $user->email_confirm_token
        ]
    ));
?>

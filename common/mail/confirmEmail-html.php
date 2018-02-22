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

$activateLink = Yii::$app->urlManager->createAbsoluteUrl(['site/activate-account', 'token' => $user->email_confirm_token]);
?>
<table class="body-wrap" style="padding: 20px !important; background-color: #f6f6f6; width: 100%; border: 1px solid 
#fcc800;">
    <tbody>
    <tr>
        <td style="vertical-align: top;"></td>
        <td class="container" width="600" style="width: 100% !important; vertical-align: top; display: block !important; max-width: 600px !important; margin: 0 auto !important; clear: both !important;">
            <div class="content" style="max-width: 600px; margin: 0 auto; display: block; padding: 20px;">
                <table class="main" width="100%" cellpadding="0" cellspacing="0" style="background: #fff; border: 1px solid #e9e9e9; border-radius: 3px;">
                    <tbody>
                    <tr>
                        <td class="alert alert-good" style="font-size: 16px; color: #fff; font-weight: 500; padding: 20px; text-align: center; border-radius: 3px 3px 0 0; background: 
#fcc800;">
                            <h3><?= Yii::t('app', 'Сообщение от {name}', ['name' => Yii::$app->name]) ?></h3>
                        </td>
                    </tr>
                    <tr>
                        <td class="content-wrap" style="vertical-align: top; padding: 0 20px 0 20px;">
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tbody>
                                <tr>
                                    <td class="content-block" style="vertical-align: top;">
                                        <h4><?= Yii::t('app', 'Здравствуйте') ?> <?= Html::encode($user->username ? $user->username : 'Пользователь') ?>,</h4>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="content-block" style=" vertical-align: top;">
                                        <p>
                                        <?= Yii::t('app', 'Ваш логин'). ':  '. $user->email ?><br>
                                        <?= Yii::t('app', 'Ваш пароль'). ':  '. \common\models\extend\UserExtend::decript($user->password_encrypted) ?>
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="content-block" style="vertical-align: top;">
                                            <?= Html::a(Yii::t('app', 'Активация аккаунта'), $activateLink,
                                                [
                                                    'style' => 'text-decoration: none; 
                                                    color: #FFF;
                                                    background-color: 
                                                    #fcc800;
                                                    border: solid 
                                                    #fcc800;
                                                    border-width: 5px 10px;
                                                    line-height: 2;
                                                    font-weight: bold;
                                                    text-align: center;
                                                    cursor: pointer;
                                                    display: inline-block;
                                                    border-radius: 5px;
                                                    text-transform: capitalize;
                                                    text-decoration: none;'
                                                ]) ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="content-block" style="padding: 0 0 20px; vertical-align: top;">
                                        <p><?= Yii::t('app', 'С уважением, администрация сайта {name}.', ['name' => Yii::$app->name]) ?></p>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="footer" style="width: 100%; clear: both; color: #999;">
                    <table width="100%">
                        <tbody>
                        <tr>
                            <td class="aligncenter content-block" style="font-size: 16px; color: #fff; font-weight: 500; padding: 20px; text-align: center; border-radius: 3px 3px 0 0; background: 
#fcc800;">
                                <h3><?= Html::a(Yii::$app->name, Yii::$app->params['frontendUrl'],
                                        [
                                            'style' => 'text-decoration: none;
                                        color: #FFF;
                                        text-decoration: none;'
                                        ]) ?>
                                </h3>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </td>
    </tr>
    </tbody>
</table>
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

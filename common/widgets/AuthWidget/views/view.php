<?php
/**
 * Created by PhpStorm.
 * User: Raketos
 * Date: 28.05.2016
 * Time: 23:37
 */

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $widget \common\widgets\AuthWidget\AuthWidget */
/* @var $user \common\models\extend\UserExtend */

$user = Yii::$app->user->identity;
?>
<?php
if (Yii::$app->user->isGuest):
    ?>
    <?php
    if (Yii::$app->controller->action->id != 'login'):
        ?>
        <?= $this->render('_login',
        [
            'widget' => $widget,
        ]) ?>
        <?php
    endif;
    ?>
    <?php
    if (Yii::$app->controller->action->id != 'signup'):
        ?>
        <?= $this->render('_signup',
        [
            'widget' => $widget,
        ]); ?>
        <?php
    endif;
    ?>
    <?php
else:
    ?>
    <?= Html::a('<i class="fa fa-user" aria-hidden="true" style="margin-right: 5px;"></i>Личный кабинет', Url::to(['/profile']),
    [
        'class' => 'black-link float-ld-md-right',
        'style' => 'outline: none; margin-right: 20px;',
    ]) ?>
    <?= Html::a('<i class="fa fa-sign-out" aria-hidden="true" style="margin-right: 5px;"></i>Выход', Url::to(['/site/logout']),
    [
        'class' => 'black-link float-ld-md-right',
        'style' => 'outline: none; margin-right: 20px;',
    ]) ?>
    <?/*= 'Баланс: '.$user->balance.' <span class="glyphicon glyphicon-ruble"></span>' */?>
    <?/*= Html::beginForm(['/site/logout'], 'post')
. Html::submitButton(
    Yii::t('app', 'Выйти ({user})', ['user' => $user->username]),
    [
        'class' => 'black-link float-ld-md-right',
        'style' => 'outline: none; margin-right: 20px;',
    ]
)
. Html::endForm() */?>
    <?php
    if (Yii::$app->user->can('redactor')):
    ?>
        <a href="<?= Yii::$app->params['backendUrl'] ?>" class="black-link float-ld-md-right" style="outline: none;" target="_blank"><i class="fa fa-cog" style="margin-right: 20px;"></i></a>
        <?php
        endif;
            ?>
    <?php
endif;;
?>


<?php
/**
 * Created by PhpStorm.
 * User: Raketos - http://raketos.ru
 * Date: 02.06.2016
 * Time: 22:23
 */

use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Html;
use phpnt\oAuth\AuthChoice;

/* @var $this yii\web\View */
/* @var $model \common\models\forms\LoginForm  */
/* @var $form ActiveForm */
?>
<div class="row">
    <?php $form = ActiveForm::begin([
        'action' => Url::to(['/site/login']),
        'fieldConfig' => [
            'template' => '{label}<div class="input-group">{input}
                            <span class="input-group-addon"><i class="fa fa-{font-awesome}"></i></span>
                         </div><i>{hint}</i>{error}'
        ],
        'options' => ['data-pjax' => true]
    ]); ?>
    <div class="box-body" style="margin-top: 30px;">

        <div class="col-md-12 text-left">
            <?= $form->field($model, 'email', ['parts' => ['{font-awesome}' => 'user']])
                ->textInput(['placeholder' => $model->getAttributeLabel('username')]) ?>
        </div>

        <div class="col-md-12 text-left">
            <?= $form->field($model, 'password', ['parts' => ['{font-awesome}' => 'lock']])
                ->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <?= Html::submitButton(Yii::t('app', 'Войти'), ['class' => 'btn btn-primary full-width', 'name' => 'login-button']) ?><br><br>
                <?= Html::button(Yii::t('app', 'Регистрация'), ['class' => 'btn btn-primary full-width', 'data-toggle' => 'modal', 'data-target' => '#signinModal']) ?>
            </div>
        </div>

    </div>
    <?php ActiveForm::end(); ?>

    <div class="col-md-12 text-center">
        <?= Html::a(Yii::t('app', 'Забыли пароль?'), ['site/request-password-reset']) ?>.
    </div>

    <div class="col-md-12">
        <p class="hint-block"><?= Yii::t('app', 'Войти с помощью социальных сетей')?>:</p>
        <?php echo \nodge\eauth\Widget::widget(array('action' => '/site/login')); ?>
    </div>
<?php
    if (Yii::$app->getSession()->hasFlash('error')) {
        echo '<div class="alert alert-danger">'.Yii::$app->getSession()->getFlash('error').'</div>';
    }
?>
  
    
   
</div>

<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\forms\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('app', 'Войти');
$this->params['breadcrumbs'][] = $this->title;
?>

<div>
    <h2 class="" style="color: #b4b4b4;"><?= Yii::t('app', 'Панель управления') ?></h2>
</div>
<h3 style="text-transform: uppercase"></h3>
<!--<p>Панель управления</p>-->

<?php $form = ActiveForm::begin(['fieldConfig' => [
    'template' => '{label}<div class="input-group">{input}
                            <span class="input-group-addon"><i class="fa fa-{font-awesome}"></i></span>
                         </div><i>{hint}</i>{error}'
]]); ?>
<div class="box-body" style="margin-top: 30px;">

    <div class="col-md-12 text-left">
        <?= $form->field($model, 'email', ['parts' => ['{font-awesome}' => 'user']])
            ->textInput(['placeholder' => Yii::t('app', 'Логин')]) ?>
    </div>

    <div class="col-md-12 text-left">
        <?= $form->field($model, 'password', ['parts' => ['{font-awesome}' => 'lock']])
            ->passwordInput(['placeholder' => Yii::t('app', 'Пароль')]) ?>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Войти'), ['class' => 'btn btn-primary full-width', 'name' => 'login-button']) ?>
        </div>
    </div>

</div>
<?php ActiveForm::end(); ?>

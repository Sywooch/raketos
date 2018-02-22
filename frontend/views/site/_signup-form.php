<?php
/**
 * Created by PhpStorm.
 * User: Raketos - http://raketos.ru
 * Date: 02.06.2016
 * Time: 22:10
 */
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\bootstrap\Html;
use yii\widgets\MaskedInput;
use yii\widgets\Pjax;
//use phpnt\oAuth\AuthChoice;

/* @var $this yii\web\View */
/* @var $model \common\models\forms\SignupForm */
/* @var $key integer */
?>
<?php Pjax::begin([
    'id' => 'pjaxBlock',
    'enablePushState' => false
]); ?>
    <div id="elements-form-block">
       <?php $form = ActiveForm::begin([
            'id' => 'form',
            'action' => Url::to(['/site/signup']),
            'options' => ['data-pjax' => true]]); ?>
        <div class="row">

            <div class="col-md-12">
                <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('email')]) ?>
            </div>

            <div class="col-md-12">
                <?php
                if (isset($model->phone)) {
                    $model->input_phone = $model->getPhoneWithoutCode();
                }
                ?>
                <?= $form->field($model, 'input_phone', ['template' => '{label} 
                                            <div class="input-group">
                                                <span class="input-group-addon">+7</span>{input}
                                             </div>
                                            <i>{hint}</i>{error}'])
                    ->widget(MaskedInput::className(),[
                        'options' => [
                            'class' => 'form-control',
                            'id'    => 'mask',
                        ],
                        'name' => 'input_phone',
                        'mask' => '(999) 999-99-99']) ?>
            </div>

            <div class="col-md-12 text-center">
                <div class="form-group">
                    <?= Html::submitButton('Зарегистрироваться', ['class' => 'btn btn-primary']) ?>
                </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>

        <p class="hint-block"><?= Yii::t('app', 'Зарегистрироваться с помощью социальных сетей')?>:</p>


<?php
    if (Yii::$app->getSession()->hasFlash('error')) {
        echo '<div class="alert alert-danger">'.Yii::$app->getSession()->getFlash('error').'</div>';
    }
?>

<!--<p class="lead">Do you already have an account on one of these sites? Click the logo to log in with it here:</p>-->
<?php echo \nodge\eauth\Widget::widget(array('action' => '/site/login')); ?>
    </div>
<?php
Pjax::end();
?>
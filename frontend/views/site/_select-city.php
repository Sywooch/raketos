<?php
/**
 * Created by PhpStorm.
 * User: Raketos - http://raketos.ru
 * Date: 07.02.2017
 * Time: 12:02
 */
use yii\widgets\Pjax;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\bootstrap\Html;
use common\widgets\Forms\CityMainField;

Pjax::begin(['id' => 'pjaxBlock22']); ?>
<?php $form = ActiveForm::begin([
    'id' => 'form',
    'action' => Url::to(['/geo/select-city']),
    'options' => ['data-pjax' => true]]); ?>
    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'city')->widget(CityMainField::className(),['country' => 185]) ?>
        </div>
        <?= Html::hiddenInput('model', 'common\models\forms\SelectCityForm') ?>
        <?= Html::hiddenInput('form', '@backend/modules/user/views/manage/_select-city') ?>
    </div>
<?php ActiveForm::end(); ?>

<?php
Pjax::end();
?>
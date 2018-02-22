<?php
use phpnt\bootstrapNotify\BootstrapNotify;
use yii\widgets\Pjax;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\bootstrap\Html;
use yii\bootstrap\Collapse;

/* @var $this yii\web\View */
/* @var $model \common\models\forms\RatingCalculateForm */

$this->title = 'Расчет рейтинга';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="col-md-12">
    <div class="ibox">
        <div class="ibox-content">
            <?= Collapse::widget([
                'items' => [
                    [
                        'label' => 'О данном разделе',
                        'content' => 'В данном разделе происходит расчет рейтинга. Если используется константа, то она, как и арифметическое действие, должна быть в одном поле единственным значением.<br>
                            ',
                    ],
                ]]); ?>
        </div>
    </div>
</div>

<?= BootstrapNotify::widget() ?>
<div class="calculate-form-index" style="height: 100%">
    <?= BootstrapNotify::widget() ?>
    <div class="ibox float-e-margins" style="background-color: #fff;">
        <div class="ibox-title">
            <div class="col-md-12">
                <h3>Текущая формула:
                    <?= $model->getFormula() ?>
                </h3>
            </div>
            <div class="col-md-6" style="background-color: #fff;">
                <h3>Возможные значения</h3>
                <p><?= $model->getAttributeLabel('mileage') ?> - <strong>П</strong></p>
                <p><?= $model->getAttributeLabel('year') ?> - <strong>Г</strong></p>
                <p><?= $model->getAttributeLabel('state') ?> - <strong>С</strong></p>
                <p><?= $model->getAttributeLabel('rating') ?> - <strong>Р</strong></p>
                <p><?= $model->getAttributeLabel('price') ?> - <strong>Ц</strong></p>
            </div>
            <div class="col-md-6" style="background-color: #fff;">
                <h3>Арифметические операции</h3>
                <p>Сложение - <strong>+</strong></p>
                <p>Вычитание - <strong>-</strong></p>
                <p>Умножение - <strong>*</strong></p>
                <p>Деление - <strong>/</strong></p>
                <p>Действия за скобками - <strong>( ... )</strong></p>
            </div>
        </div>
    </div>
    <div class="ibox-content">
        <div id="editable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
            <?php Pjax::begin(); ?>
            <?php $form = ActiveForm::begin([
                'action' => Url::to(['update']),
                //'options' => ['data-pjax' => true],
            ]); ?>

            <div class="col-md-1">
                <?= $form->field($model, 'item1')->textInput([])->error(false) ?>
            </div>
            <div class="col-md-1">
                <?= $form->field($model, 'item2')->textInput([])->error(false) ?>
            </div>
            <div class="col-md-1">
                <?= $form->field($model, 'item3')->textInput([])->error(false) ?>
            </div>
            <div class="col-md-1">
                <?= $form->field($model, 'item4')->textInput([])->error(false) ?>
            </div>
            <div class="col-md-1">
                <?= $form->field($model, 'item5')->textInput([])->error(false) ?>
            </div>
            <div class="col-md-1">
                <?= $form->field($model, 'item6')->textInput([])->error(false) ?>
            </div>
            <div class="col-md-1">
                <?= $form->field($model, 'item7')->textInput([])->error(false) ?>
            </div>
            <div class="col-md-1">
                <?= $form->field($model, 'item8')->textInput([])->error(false) ?>
            </div>
            <div class="col-md-1">
                <?= $form->field($model, 'item9')->textInput([])->error(false) ?>
            </div>
            <div class="col-md-1">
                <?= $form->field($model, 'item10')->textInput([])->error(false) ?>
            </div>
            <div class="col-md-1">
                <?= $form->field($model, 'item11')->textInput([])->error(false) ?>
            </div>
            <div class="col-md-1">
                <?= $form->field($model, 'item12')->textInput([])->error(false) ?>
            </div>
            <div class="col-md-1">
                <?= $form->field($model, 'item13')->textInput([])->error(false) ?>
            </div>
            <div class="col-md-1">
                <?= $form->field($model, 'item14')->textInput([])->error(false) ?>
            </div>
            <div class="col-md-1">
                <?= $form->field($model, 'item15')->textInput([])->error(false) ?>
            </div>
            <div class="col-md-1">
                <?= $form->field($model, 'item16')->textInput([])->error(false) ?>
            </div>
            <div class="col-md-1">
                <?= $form->field($model, 'item17')->textInput([])->error(false) ?>
            </div>
            <div class="col-md-1">
                <?= $form->field($model, 'item18')->textInput([])->error(false) ?>
            </div>
            <div class="col-md-1">
                <?= $form->field($model, 'item19')->textInput([])->error(false) ?>
            </div>
            <div class="col-md-1">
                <?= $form->field($model, 'item20')->textInput([])->error(false) ?>
            </div>
            <div class="col-md-1">
                <?= $form->field($model, 'item21')->textInput([])->error(false) ?>
            </div>
            <div class="col-md-1">
                <?= $form->field($model, 'item22')->textInput([])->error(false) ?>
            </div>
            <div class="col-md-1">
                <?= $form->field($model, 'item23')->textInput([])->error(false) ?>
            </div>
            <div class="col-md-1">
                <?= $form->field($model, 'item24')->textInput([])->error(false) ?>
            </div>

            <div class="clearfix"></div>

            <div class="text-center" style="margin-top: 60px;">
                <div class="form-group">
                    <?= Html::submitButton('Изменить', ['class' => 'btn btn-primary']) ?>
                </div>
            </div>

            <?php ActiveForm::end(); ?>
            <?php Pjax::end(); ?>
        </div>
    </div>
</div>



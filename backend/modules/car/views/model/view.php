<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Modal;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\widgets\Pjax;
use phpnt\bootstrapSelect\BootstrapSelectAsset;

/* @var $this yii\web\View */
/* @var $model common\models\forms\SelectCarForm */
/* @var $idModal string */

$this->title = 'Модели автомобилей';
?>
<?php
Pjax::begin([
    'id' => 'pjaxBlock',
    'enablePushState' => false,
]);

BootstrapSelectAsset::register($this);
?>
<div class="car-model-form-view">
    <div class="col-md-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h1><?= $this->title ?></h1>
            </div>
            <div class="ibox-content">
                <div class="row">
                    <?php $form = ActiveForm::begin([
                        'id' => 'form',
                        'options' => ['data-pjax' => true]]); ?>

                    <div class="col-md-12">
                        <?php
                        $model->marka = $model->mark->id_car_mark;
                        ?>
                        <?= $form->field($model, 'marka')->dropDownList($model->markList, [
                            'class'     => 'form-control selectpicker',
                            'disabled'  => true,
                            'data' => [
                                'style' => 'btn-default',
                            ]
                        ]); ?>
                    </div>

                    <div class="col-md-12">
                        <?= $form->field($model, 'name')->dropDownList($model->modelList, [
                            'class'     => 'form-control selectpicker',
                            'disabled'  => true,
                            'data' => [
                                'style' => 'btn-default',
                            ]
                        ]); ?>
                    </div>

                    <div class="col-md-12">
                        <?= $form->field($model, 'generation')->dropDownList($model->generationList, [
                            'class'     => 'form-control selectpicker',
                            'data' => [
                                'style' => 'btn-primary',
                                'title' => $model->getAttributeLabel('generation')
                            ],
                            'onchange' => '
                                $.pjax({
                                    type: "POST",
                                    url: "'.Url::to(['/car/model/select-generation', 'id' => $model->id_car_model]).'",
                                    data: jQuery("#form").serialize(),
                                    container: "#pjaxBlock",
                                    push: false,
                                    scrollTo: false
                                })'
                        ]); ?>
                    </div>

                    <?php
                    if ($model->generation):
                    ?>
                        <div class="col-md-12">
                            <?= $form->field($model, 'serie')->dropDownList($model->serieList, [
                                'class'     => 'form-control selectpicker',
                                //'disabled'  => true,
                                'data' => [
                                    'style' => 'btn-primary',
                                    'title' => $model->getAttributeLabel('serie')
                                ],
                                'onchange' => '
                                $.pjax({
                                    type: "POST",
                                    url: "'.Url::to(['/car/model/select-serie', 'id' => $model->id_car_model]).'",
                                    data: jQuery("#form").serialize(),
                                    container: "#pjaxBlock",
                                    push: false,
                                    scrollTo: false
                                })'
                            ]); ?>
                        </div>
                    <?php
                    endif;
                    ?>

                    <?php
                    if ($model->serie):
                        ?>
                        <div class="col-md-12">
                            <?= $form->field($model, 'modification')->dropDownList($model->modificationList, [
                                'class'     => 'form-control selectpicker',
                                //'disabled'  => true,
                                'data' => [
                                    'style' => 'btn-primary',
                                    'title' => $model->getAttributeLabel('modification')
                                ],
                                'onchange' => '
                                $.pjax({
                                    type: "POST",
                                    url: "'.Url::to(['/car/model/select-modification', 'id' => $model->id_car_model]).'",
                                    data: jQuery("#form").serialize(),
                                    container: "#pjaxBlock",
                                    push: false,
                                    scrollTo: false
                                })'
                            ]); ?>
                        </div>
                        <?php
                    endif;
                    ?>

                    <?php ActiveForm::end(); ?>
                    <div class="clearfix"></div>
                </div>
                <div class="row">
                    <?php
                    if ($model->modification):
                    ?>
                        <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            [
                                'label' => 'Общие данные',
                                'format' => 'raw',
                                'value' => call_user_func(function ($data) {
                                    /* @var $data \common\models\forms\SelectCarForm */
                                    $string = '';
                                    $string .= '<h3 style="padding-top: 5px; padding-bottom: 0;">Характеристики</h3>';
                                    $characteristicValues = $data->characteristicValueList;
                                    foreach ($characteristicValues as $characteristicValue) {
                                        /* @var $characteristicValue \common\models\CarCharacteristicValue */
                                        if ($characteristicValue->unit) {
                                            $string .= $characteristicValue->characteristic->name.': '.$characteristicValue->value.' ('.$characteristicValue->unit.')<br>';
                                        } else {
                                            $string .= $characteristicValue->characteristic->name.': '.$characteristicValue->value.'<br>';
                                        }
                                    }

                                    $equipments = $data->equipmentList;
                                    if ($equipments) {
                                        $string .= '<h3 style="padding-top: 5px; padding-bottom: 0;">Опции</h3>';
                                        foreach ($equipments as $equipment) {
                                            // @var $equipment \common\models\CarEquipment
                                            $string .= 'Название: ' . $equipment->name . '<br>';
                                            if ($equipment->price_min) {
                                                $string .= 'Дилерская цена в рублях: ' . $equipment->price_min . '<br>';
                                            }
                                            if ($equipment->year) {
                                                $string .= 'Год выпуска: ' . $equipment->year . '<br>';
                                            }

                                            if (isset($equipment->cptionValues)) {
                                                $string .= '<h5 style="padding-top: 5px; padding-bottom: 0; text-decoration: underline">Опции</h5>';
                                                foreach ($equipment->cptionValues as $optionValue) {
                                                    // @var $optionValue \common\models\CarOptionValue
                                                    if ($optionValue->is_base) {
                                                        $string .= $optionValue->option->name . ' (базовая)<br>';
                                                    } else {
                                                        $string .= $optionValue->option->name . ' (дополнительная)<br>';
                                                    }
                                                }
                                            }
                                        }
                                    }

                                    /*$string .= '<h5 style="padding-top: 5px; padding-bottom: 0; text-decoration: underline">Комплектации</h5>';
foreach ($modification->equipments as $equipment) {
    // @var $equipment \common\models\CarEquipment
    $string .= 'Название: '.$equipment->name.'<br>';
    $string .= 'Дилерская цена в рублях: '.$equipment->price_min.'<br>';
    $string .= 'Год выпуска: '.$equipment->year.'<br>';
    if (isset($equipment->cptionValues)) {
        $string .= '<h5 style="padding-top: 5px; padding-bottom: 0; text-decoration: underline">Опции</h5>';
        foreach ($equipment->cptionValues as $optionValue) {
            // @var $optionValue \common\models\CarOptionValue
            if ($optionValue->is_base) {
                $string .= $optionValue->option->name . ' (базовая)<br>';
            } else {
                $string .= $optionValue->option->name . ' (дополнительная)<br>';
            }
        }
    }
}*/
                                 return $string;
                                }, $model),
                            ],
                        ],
                    ]) ?>
                    <?php
                    endif;
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
Pjax::end();
?>


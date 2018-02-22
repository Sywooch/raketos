<?php

use yii\bootstrap\Html;
use yii\bootstrap\ActiveForm;
use phpnt\bootstrapSelect\BootstrapSelectAsset;
use yii\helpers\Url;
use yii\widgets\Pjax;
use phpnt\awesomeBootstrapCheckbox\AwesomeBootstrapCheckboxAsset;

/* @var $this yii\web\View */
/* @var $model common\models\search\AdsSearch */
/* @var $form yii\widgets\ActiveForm */

//BootstrapSelectAsset::register($this);
?>

<div class="ads-form-search">
    <?php
    Pjax::begin([
        'id' => 'pjaxBlock',
        'enablePushState' => false,
    ]);
    BootstrapSelectAsset::register($this);
    AwesomeBootstrapCheckboxAsset::register($this);
    ?>
    <?php $form = ActiveForm::begin([
        'id' => 'form',
        'action' => ['search'],
        'method' => 'get',
    ]); ?>

    <div class="col-md-3">
        <?= $form->field($model, 'city_id')->dropDownList($model->getCities(), [
            'class'     => 'form-control selectpicker',
            //'disabled'  => $model->id_car_model ? true : false,
            'multiple' => false,
            'data' => [
                'style' => 'btn-default',
                'live-search' => 'true',
                'size' => 10,
                'title' => $model->getAttributeLabel('city_id')
            ],
        ]); ?>
    </div>
    
    <div class="clearfix"></div>

    <div class="col-md-2">
        <?= $form->field($model, 'id_car_mark')->dropDownList($model->markList, [
            'class'     => 'form-control selectpicker',
            //'disabled'  => true,
            'data' => [
                'style' => 'btn-default',
                'live-search' => 'true',
                'size' => 10,
                'title' => $model->getAttributeLabel('id_car_mark')
            ],
            'onchange' => '
            var id = $(this).val();
            $.pjax({
                type: "POST",
                url: "'.Url::to(['/users-car/select-mark?id=']).'" + id,
                data: jQuery("#form").serialize(),
                container: "#pjaxBlock",
                push: false,
                scrollTo: false
            })'
        ]); ?>
    </div>


    <?php
    if ($model->id_car_mark):
        ?>
            <?php
            $count = count($model->modelList);
            if ($count == 1):
                $model->id_car_model = $model->getKey($model->modelList);
                echo $form->field($model, 'id_car_model')->hiddenInput()->label(false);
                ?>
                <?php
            else:
                ?>
                <div class="col-md-2">
                <?= $form->field($model, 'id_car_model')->dropDownList($model->modelList, [
                'class'     => 'form-control selectpicker',
                //'disabled'  => $model->id_car_model ? true : false,
                'data' => [
                    'style' => 'btn-default',
                    'live-search' => 'true',
                    'size' => 10,
                    'title' => $model->getAttributeLabel('id_car_model')
                ],
                'onchange' => '
            var id = $(this).val();
            $.pjax({
                type: "POST",
                url: "'.Url::to(['/users-car/select-model?id=']).'" + id,
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
    endif;
    ?>



    <?php
    if ($model->id_car_model):
        ?>
           <?php
            $count = count($model->generationList);
            if ($count == 1):
                $model->id_car_generation = $model->getKey($model->generationList);
                echo $form->field($model, 'id_car_generation')->hiddenInput()->label(false);
                ?>
                <?php
            else:
                ?>
                <div class="col-md-3">
                <?= $form->field($model, 'id_car_generation')->dropDownList($model->generationList, [
                'class'     => 'form-control selectpicker',
                //'disabled'  => $model->id_car_generation ? true : false,
                'data' => [
                    'style' => 'btn-default',
                    'live-search' => 'true',
                    'size' => 10,
                    'title' => $model->getAttributeLabel('id_car_generation')
                ],
                'onchange' => '
            var id = $(this).val();
            $.pjax({
                type: "POST",
                url: "'.Url::to(['/users-car/select-generation?id=']).'" + id,
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
    endif;
    ?>

    <?php
    if ($model->id_car_generation):
        ?>
            <?php
            $count = count($model->serieList);
            if ($count == 1):
                $model->id_car_serie = $model->getKey($model->serieList);
                echo $form->field($model, 'id_car_serie')->hiddenInput()->label(false);
                ?>
                <?php
            else:
                ?>
                <div class="col-md-3">
                <?= $form->field($model, 'id_car_serie')->dropDownList($model->serieList, [
                'class'     => 'form-control selectpicker',
                //'disabled'  => $model->id_car_serie ? true : false,
                'data' => [
                    'style' => 'btn-default',
                    'live-search' => 'true',
                    'size' => 10,
                    'title' => $model->getAttributeLabel('id_car_serie')
                ],
                'onchange' => '
            var id = $(this).val();
            $.pjax({
                type: "POST",
                url: "'.Url::to(['/users-car/select-serie?id=']).'" + id, 
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
    endif;
    ?>

    <?php
    if ($model->id_car_serie):
        ?>
            <?php
            $count = count($model->modificationList);
            if ($count == 1):
                $model->id_car_modification = $model->getKey($model->modificationList);
                echo $form->field($model, 'id_car_modification')->hiddenInput()->label(false);
                ?>
                <?php
            else:
                ?>
                <div class="col-md-3">
                <?= $form->field($model, 'id_car_modification')->dropDownList($model->modificationList, [
                'class'     => 'form-control selectpicker',
                //'disabled'  => $model->id_car_modification ? true : false,
                'data' => [
                    'style' => 'btn-default',
                    'live-search' => 'true',
                    'size' => 10,
                    'title' => $model->getAttributeLabel('id_car_modification')
                ],
                'onchange' => '
            var id = $(this).val();
            $.pjax({
                type: "POST",
                url: "'.Url::to(['/users-car/select-modification?id=']).'" + id, 
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
    endif;
    ?>

    <div class="clearfix"></div>

    <div class="col-md-3">
        <?= $form->field($model, 'price_from', ['template' => '{label}<div class="input-group">
               <span class="input-group-addon filter-group-addon">от</span>
                {input}
               <span class="input-group-addon filter-group-addon"><span class="glyphicon glyphicon-rub"></span></span>
                         </div><i>{hint}</i>{error}'])
            ->textInput([/*'placeholder' => 'от'*/])->error(false) ?>
        <?= $form->field($model, 'price_to', ['template' => '{label}<div class="input-group">
               <span class="input-group-addon filter-group-addon">до</span>
                {input}
               <span class="input-group-addon filter-group-addon"><span class="glyphicon glyphicon-rub"></span></span>
                         </div><i>{hint}</i>{error}'])
            ->textInput([/*'placeholder' => 'от'*/])->error(false)->label(false) ?>
    </div>

    <div class="col-md-3">
        <?= $form->field($model, 'mileage_from', ['template' => '{label}<div class="input-group">
               <span class="input-group-addon filter-group-addon">от</span>
                {input}
               <span class="input-group-addon filter-group-addon"><span class="glyphicon glyphicon-road"></span></span>
                         </div><i>{hint}</i>{error}'])
            ->textInput([/*'placeholder' => 'от'*/])->error(false) ?>
        <?= $form->field($model, 'mileage_to', ['template' => '{label}<div class="input-group">
               <span class="input-group-addon filter-group-addon">до</span>
                {input}
               <span class="input-group-addon filter-group-addon"><span class="glyphicon glyphicon-road"></span></span>
                         </div><i>{hint}</i>{error}'])
            ->textInput([/*'placeholder' => 'от'*/])->error(false)->label(false) ?>
    </div>

    <div class="col-md-2">
        <?= $form->field($model, 'year_from', ['template' => '{label}<div class="input-group">
               <span class="input-group-addon filter-group-addon">от</span>
                {input}</div><i>{hint}</i>{error}'])
            ->textInput([/*'placeholder' => 'от'*/])->error(false) ?>
        <?= $form->field($model, 'year_to', ['template' => '{label}<div class="input-group">
               <span class="input-group-addon filter-group-addon">до</span>
                {input}</div><i>{hint}</i>{error}'])
            ->textInput([/*'placeholder' => 'от'*/])->error(false)->label(false) ?>
    </div>

    <div class="col-md-2">
        <?= $form->field($model, 'power_from', ['template' => '{label}<div class="input-group">
               <span class="input-group-addon filter-group-addon">от</span>
                {input}</div><i>{hint}</i>{error}'])
            ->textInput([/*'placeholder' => 'от'*/])->error(false) ?>
        <?= $form->field($model, 'power_to', ['template' => '{label}<div class="input-group">
               <span class="input-group-addon filter-group-addon">до</span>
                {input}</div><i>{hint}</i>{error}'])
            ->textInput([/*'placeholder' => 'от'*/])->error(false)->label(false) ?>
    </div>

    <div class="col-md-2">
        <?= $form->field($model, 'capacity_from', ['template' => '{label}<div class="input-group">
               <span class="input-group-addon filter-group-addon">от</span>
                {input}</div><i>{hint}</i>{error}'])
            ->textInput([/*'placeholder' => 'от'*/])->error(false) ?>
        <?= $form->field($model, 'capacity_to', ['template' => '{label}<div class="input-group">
               <span class="input-group-addon filter-group-addon">до</span>
                {input}</div><i>{hint}</i>{error}'])
            ->textInput([/*'placeholder' => 'от'*/])->error(false)->label(false) ?>
    </div>

    <div class="col-md-3">
        <?= $form->field($model, 'engine_type')->dropDownList($model->engineTypeList, [
            'class'     => 'form-control selectpicker',
            'style'     => 'color: #000 !important;',
            //'disabled'  => true,
            'multiple' => true,
            'data' => [
                'style' => 'btn btn-default',
                //'live-search' => 'true',
                'size' => 10,
                'title' => $model->getAttributeLabel('engine_type')
            ],
        ]); ?>
    </div>



    <div class="col-md-3">
        <?= $form->field($model, 'gearbox_type')->dropDownList($model->gearboxTypeList, [
            'class'     => 'form-control selectpicker',
            'style'     => 'color: #000 !important;',
            //'disabled'  => true,
            'multiple' => true,
            'data' => [
                'style' => 'btn btn-default',
                //'live-search' => 'true',
                'size' => 10,
                'title' => $model->getAttributeLabel('gearbox_type')
            ],
        ]); ?>
    </div>



    <div class="col-md-3">
        <?= $form->field($model, 'drive_unit')->dropDownList($model->driveUnitList, [
            'class'     => 'form-control selectpicker',
            'style'     => 'color: #000 !important;',
            //'disabled'  => true,
            'multiple' => true,
            'data' => [
                'style' => 'btn btn-default',
                //'live-search' => 'true',
                'size' => 10,
                'title' => $model->getAttributeLabel('drive_unit')
            ],
        ]); ?>
    </div>


    <div class="col-md-3">
        <?= $form->field($model, 'fuel_grade')->dropDownList($model->fuelGradeList, [
            'class'     => 'form-control selectpicker',
            'style'     => 'color: #000 !important;',
            //'disabled'  => true,
            'multiple' => true,
            'data' => [
                'style' => 'btn btn-default',
                //'live-search' => 'true',
                'size' => 10,
                'title' => $model->getAttributeLabel('fuel_grade')
            ],
        ]); ?>
    </div>



    <!--<div class="col-md-3">
        <?/*= $form->field($model, 'eco_standard')->dropDownList($model->ecoStandardList, [
            'class'     => 'form-control selectpicker',
            'style'     => 'color: #000 !important;',
            //'disabled'  => true,
            //'multiple' => true,
            'data' => [
                'style' => 'btn btn-default',
                'live-search' => 'true',
                'size' => 10,
                'title' => $model->getAttributeLabel('eco_standard')
            ],
        ]); */?>
    </div>-->








    <div class="col-md-3">
        <?= $form->field($model, 'ground_clearance_from', ['template' => '{label}<div class="input-group">
               <span class="input-group-addon filter-group-addon">от</span>
                {input}</div><i>{hint}</i>{error}'])
            ->textInput([/*'placeholder' => 'от'*/])->error(false) ?>
        <?= $form->field($model, 'ground_clearance_to', ['template' => '{label}<div class="input-group">
               <span class="input-group-addon filter-group-addon">до</span>
                {input}</div><i>{hint}</i>{error}'])
            ->textInput([/*'placeholder' => 'от'*/])->error(false)->label(false) ?>
    </div>


    <div class="col-md-3">
        <?= $form->field($model, 'number_of_seats_from', ['template' => '{label}<div class="input-group">
               <span class="input-group-addon filter-group-addon">от</span>
                {input}</div><i>{hint}</i>{error}'])
            ->textInput([/*'placeholder' => 'от'*/])->error(false) ?>
        <?= $form->field($model, 'number_of_seats_to', ['template' => '{label}<div class="input-group">
               <span class="input-group-addon filter-group-addon">до</span>
                {input}</div><i>{hint}</i>{error}'])
            ->textInput([/*'placeholder' => 'от'*/])->error(false)->label(false) ?>
    </div>

    <div class="col-md-3">
        <?= $form->field($model, 'wheelbase_from', ['template' => '{label}<div class="input-group">
               <span class="input-group-addon filter-group-addon">от</span>
                {input}</div><i>{hint}</i>{error}'])
            ->textInput([/*'placeholder' => 'от'*/])->error(false) ?>
        <?= $form->field($model, 'wheelbase_to', ['template' => '{label}<div class="input-group">
               <span class="input-group-addon filter-group-addon">до</span>
                {input}</div><i>{hint}</i>{error}'])
            ->textInput([/*'placeholder' => 'от'*/])->error(false)->label(false) ?>
    </div>






    <div class="col-md-3">
        <?= $form->field($model, 'turnover_of_max_power_from', ['template' => '{label}<div class="input-group">
               <span class="input-group-addon filter-group-addon">от</span>
                {input}</div><i>{hint}</i>{error}'])
            ->textInput([/*'placeholder' => 'от'*/])->error(false) ?>
        <?= $form->field($model, 'turnover_of_max_power_to', ['template' => '{label}<div class="input-group">
               <span class="input-group-addon filter-group-addon">до</span>
                {input}</div><i>{hint}</i>{error}'])
            ->textInput([/*'placeholder' => 'от'*/])->error(false)->label(false) ?>
    </div>

    <div class="col-md-3">
        <?= $form->field($model, 'max_torque_from', ['template' => '{label}<div class="input-group">
               <span class="input-group-addon filter-group-addon">от</span>
                {input}</div><i>{hint}</i>{error}'])
            ->textInput([/*'placeholder' => 'от'*/])->error(false) ?>
        <?= $form->field($model, 'max_torque_to', ['template' => '{label}<div class="input-group">
               <span class="input-group-addon filter-group-addon">до</span>
                {input}</div><i>{hint}</i>{error}'])
            ->textInput([/*'placeholder' => 'от'*/])->error(false)->label(false) ?>
    </div>



    <div class="col-md-3">
        <?= $form->field($model, 'max_speed_from', ['template' => '{label}<div class="input-group">
               <span class="input-group-addon filter-group-addon">от</span>
                {input}</div><i>{hint}</i>{error}'])
            ->textInput([/*'placeholder' => 'от'*/])->error(false) ?>
        <?= $form->field($model, 'max_speed_to', ['template' => '{label}<div class="input-group">
               <span class="input-group-addon filter-group-addon">до</span>
                {input}</div><i>{hint}</i>{error}'])
            ->textInput([/*'placeholder' => 'от'*/])->error(false)->label(false) ?>
    </div>

    <div class="col-md-3">
        <?= $form->field($model, 'curb_weight_from', ['template' => '{label}<div class="input-group">
               <span class="input-group-addon filter-group-addon">от</span>
                {input}</div><i>{hint}</i>{error}'])
            ->textInput([/*'placeholder' => 'от'*/])->error(false) ?>
        <?= $form->field($model, 'curb_weight_to', ['template' => '{label}<div class="input-group">
               <span class="input-group-addon filter-group-addon">до</span>
                {input}</div><i>{hint}</i>{error}'])
            ->textInput([/*'placeholder' => 'от'*/])->error(false)->label(false) ?>
    </div>

    <div class="col-md-3">
        <?= $form->field($model, 'fuel_tank_capacity_from', ['template' => '{label}<div class="input-group">
               <span class="input-group-addon filter-group-addon">от</span>
                {input}</div><i>{hint}</i>{error}'])
            ->textInput([/*'placeholder' => 'от'*/])->error(false) ?>
        <?= $form->field($model, 'fuel_tank_capacity_to', ['template' => '{label}<div class="input-group">
               <span class="input-group-addon filter-group-addon">до</span>
                {input}</div><i>{hint}</i>{error}'])
            ->textInput([/*'placeholder' => 'от'*/])->error(false)->label(false) ?>
    </div>

    <div class="col-md-3">
        <?= $form->field($model, 'acceleration_to_100_from', ['template' => '{label}<div class="input-group">
               <span class="input-group-addon filter-group-addon">от</span>
                {input}</div><i>{hint}</i>{error}'])
            ->textInput([/*'placeholder' => 'от'*/])->error(false) ?>
        <?= $form->field($model, 'acceleration_to_100_to', ['template' => '{label}<div class="input-group">
               <span class="input-group-addon filter-group-addon">до</span>
                {input}</div><i>{hint}</i>{error}'])
            ->textInput([/*'placeholder' => 'от'*/])->error(false)->label(false) ?>
    </div>

    <div class="col-md-3">
        <?= $form->field($model, 'fuel_consumption_city_for_100_from', ['template' => '{label}<div class="input-group">
               <span class="input-group-addon filter-group-addon">от</span>
                {input}</div><i>{hint}</i>{error}'])
            ->textInput([/*'placeholder' => 'от'*/])->error(false) ?>
        <?= $form->field($model, 'fuel_consumption_city_for_100_to', ['template' => '{label}<div class="input-group">
               <span class="input-group-addon filter-group-addon">до</span>
                {input}</div><i>{hint}</i>{error}'])
            ->textInput([/*'placeholder' => 'от'*/])->error(false)->label(false) ?>
    </div>

    <div class="col-md-3">
        <?= $form->field($model, 'fuel_consumption_highway_for_100_from', ['template' => '{label}<div class="input-group">
               <span class="input-group-addon filter-group-addon">от</span>
                {input}</div><i>{hint}</i>{error}'])
            ->textInput([/*'placeholder' => 'от'*/])->error(false) ?>
        <?= $form->field($model, 'fuel_consumption_highway_for_100_to', ['template' => '{label}<div class="input-group">
               <span class="input-group-addon filter-group-addon">до</span>
                {input}</div><i>{hint}</i>{error}'])
            ->textInput([/*'placeholder' => 'от'*/])->error(false)->label(false) ?>
    </div>

    <div class="col-md-3">
        <?= $form->field($model, 'fuel_consumption_mixed_cycle_for_100_from', ['template' => '{label}<div class="input-group">
               <span class="input-group-addon filter-group-addon">от</span>
                {input}</div><i>{hint}</i>{error}'])
            ->textInput([/*'placeholder' => 'от'*/])->error(false) ?>
        <?= $form->field($model, 'fuel_consumption_mixed_cycle_for_100_to', ['template' => '{label}<div class="input-group">
               <span class="input-group-addon filter-group-addon">до</span>
                {input}</div><i>{hint}</i>{error}'])
            ->textInput([/*'placeholder' => 'от'*/])->error(false)->label(false) ?>
    </div>

    <div class="col-md-2">
        <?= $form->field($model, 'mileage_rus', ['checkboxTemplate' => '<div class="checkbox-default checkbox">{input}{label}</div>'])
            ->checkbox([]) ?>
    </div>

    <div class="col-md-2">
        <?= $form->field($model, 'doc', ['checkboxTemplate' => '<div class="checkbox-default checkbox">{input}{label}</div>'])
            ->checkbox(['class' => 'checkbox-primary checkbox']) ?>
    </div>

    <div class="col-md-2">
        <?= $form->field($model, 'broken', ['checkboxTemplate' => '<div class="checkbox-default checkbox">{input}{label}</div>'])
            ->checkbox(['class' => 'checkbox-primary checkbox']) ?>
    </div>

    <div class="col-md-2">
        <?= $form->field($model, 'work', ['checkboxTemplate' => '<div class="checkbox-default checkbox">{input}{label}</div>'])
            ->checkbox(['class' => 'checkbox-primary checkbox']) ?>
    </div>

    <div class="col-md-2">
        <?= $form->field($model, 'exchange', ['checkboxTemplate' => '<div class="checkbox-default checkbox">{input}{label}</div>'])
            ->checkbox(['class' => 'checkbox-primary checkbox']) ?>
    </div>

    <!--<div class="col-md-2">
        <?/*= $form->field($model, 'is_picture', ['checkboxTemplate' => '<div class="checkbox-default checkbox">{input}{label}</div>'])
            ->checkbox(['class' => 'checkbox-primary checkbox']) */?>
    </div>-->

    <div class="clearfix"></div>

    <div class="col-md-3">
        <?= $form->field($model, 'state')->dropDownList($model->stateList, [
            'class'     => 'form-control selectpicker',
            //'disabled'  => $model->id_car_model ? true : false,
            'multiple' => true,
            'data' => [
                'style' => 'btn-default',
                //'live-search' => 'true',
                'size' => 10,
                'title' => $model->getAttributeLabel('state')
            ],
        ]); ?>
    </div>

    <div class="clearfix"></div>

    <div class="col-md-12 select-color">
        <?= $form->field($model, 'color')->checkboxList($model->colorList,
            [
                'item' => function($index, $label, $name, $checked, $value) {
                    if ($checked) {
                        $return = '<label class="radio-color '.$value.'">';
                        $return .= '<input type="checkbox" name="' . $name . '" value="' . $value . '" tabindex="3" checked="'.$checked.'">';
                        $return .= '<div><span class="color-plus"><i class="fa fa-check" aria-hidden="true"></i></span></div>';
                        $return .= '</label>';
                    } else {
                        $return = '<label class="radio-color '.$value.'">';
                        $return .= '<input type="checkbox" name="' . $name . '" value="' . $value . '" tabindex="3">';
                        $return .= '<div><span class="color-plus"><i class="fa fa-check" aria-hidden="true"></i></span></div>';
                        $return .= '</label>';
                    }
                    return $return;
                },
                'checkboxTemplate' => "<div class=\"radio\">\n{beginLabel}\n{input}\n{labelTitle}\n{endLabel}\n{error}\n{hint}\n</div>"
            ]) ?>
    </div>

    <div class="form-group text-center" style="margin-top: 40px;">
        <?= Html::submitButton('Найти', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Сброс', Url::to(['/users-car/search']), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <?php
    Pjax::end();
    ?>
</div>

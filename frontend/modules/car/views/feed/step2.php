<?php
/**
 * Created by PhpStorm.
 * User: Raketos - http://raketos.ru
 * Date: 19.03.2017
 * Time: 19:57
 */
/* @var $this yii\web\View */
/* @var $model \common\models\forms\AdsForm */

use yii\helpers\Url;
use phpnt\cropper\ImageLoadWidget;
use common\widgets\StepsNavigation\StepsNavigation;
use yii\bootstrap\Html;
use yii\bootstrap\ActiveForm;
use phpnt\awesomeBootstrapCheckbox\AwesomeBootstrapCheckboxAsset;
use common\widgets\Forms\CityField;
use yii\widgets\Pjax;
use phpnt\bootstrapSelect\BootstrapSelectAsset;

AwesomeBootstrapCheckboxAsset::register($this);
?>

<div class="ads-feed-index">
    <div class="col-md-12">
        <?php
        echo StepsNavigation::widget([
            'targetStep1' => '#confirm-step1',
            'urlStep1' => Url::to(['step-one', 'id' => $model->id]),
            'urlStep2' => Url::to(['/#']),
            'urlStep3' => Url::to(['/#']),
            'titleStep1' => Yii::t('app', 'Шаг 1. Добавить автомобиль'),
            'titleStep2' => Yii::t('app', 'Шаг 2. Указать дополнительные параметры'),
            'titleStep3' => Yii::t('app', 'Шаг 3. Подать объявление'),
            'headerStep1' => Yii::t('app', 'Шаг 1. Добавить автомобиль'),
            'headerStep2' => Yii::t('app', 'Шаг 2. Указать дополнительные параметры'),
            'headerStep3' => Yii::t('app', 'Шаг 3. Подать объявление'),
            'contentStep1' => Yii::t('app', 'Выберите Ваш автомобиль'),
            'contentStep2' => Yii::t('app', 'Загрузите фото и укажите дополнительные параметры'),
            'contentStep3' => Yii::t('app', 'Ваше объявление добавлено!'),
            'classLinkStep1' => '',
            'classLinkStep2' => 'active',
            'classLinkStep3' => 'disabled',
            'classContentStep1' => 'tab-pane',
            'classContentStep2' => 'tab-pane active',
            'classContentStep3' => 'tab-pane',
        ]);
        ?>
    </div>
    <div class="col-md-12">
        <h3>Основное изображение</h3>
    </div>
    <?= ImageLoadWidget::widget([
        'id' => 'load-user-ads',                                     // суффикс ID
        'object_id' => $model->id,                                  // ID объекта
        'imagesObject' => $model->imagesMain,                       // уже загруженные изображения
        'images_num' => 1,                                              // максимальное количество изображений
        'images_label' => $model->image_main,                       // метка для изображения
        'imageSmallWidth' => 750,                                       // ширина миниатюры
        'imageSmallHeight' => 750,                                      // высота миниатюры
        'imagePath' => '/uploads/car/',                             // путь, куда будут записыватся изображения относительно алиаса
        'noImage' => 3,                                                 // 1 - no-logo, 2 - no-avatar, 3 - no-img или путь к другой картинке
        'buttonClass'=> 'btn btn-primary',                                 // класс кнопки "обновить аватар"/"загрузить аватар" / по умолчанию btm btn-info
        'previewSize'=> 'file',                                         // размер изображения для превью(либо file_small, либо просто file)
        'pluginOptions' => [                                            // настройки плагина
            'aspectRatio' => 4/3,                                       // установите соотношение сторон рамки обрезки. По умолчанию свободное отношение.
            'strict' => false,                                          // true - рамка не может вызодить за холст, false - может
            'guides' => true,                                           // показывать пунктирные линии в рамке
            'center' => true,                                           // показывать центр в рамке изображения изображения
            'autoCrop' => true,                                         // показывать рамку обрезки при загрузке
            'autoCropArea' => 1,                                      // площидь рамки на холсте изображения при autoCrop (1 = 100% - 0 - 0%)
            'dragCrop' => true,                                         // создание новой рамки при клики в свободное место хоста (false - нельзя)
            'movable' => true,                                          // перемещать изображение холста (false - нельзя)
            'rotatable' => true,                                        // позволяет вращать изображение
            'scalable' => true,                                         // мастабирование изображения
            'zoomable' => false,
        ]]);
    ?>
    <div class="col-md-12">
        <h3>Дополнительные изображения (5 шт.)</h3>
    </div>
    <?= ImageLoadWidget::widget([
        'id' => 'load-user-photos',                                     // суффикс ID
        'object_id' => $model->id,                                       // ID объекта
        'imagesObject' => $model->imagesOther,                                // уже загруженные изображения
        'images_num' => 5,                                               // максимальное количество изображений
        'images_label' => $model->images,                                 // метка для изображения
        'imageSmallWidth' => 750,                                       // ширина миниатюры
        'imageSmallHeight' => 750,                                      // высота миниатюры
        'imagePath' => '/uploads/car/',                             // путь, куда будут записыватся изображения относительно алиаса
        'noImage' => 3,                                                 // 1 - no-logo, 2 - no-avatar или путь к другой картинке
        'buttonClass'=> 'btn btn-primary',                                 // класс кнопки "обновить аватар"/"загрузить аватар" / по умолчанию btm btn-info
        'pluginOptions' => [                                            // настройки плагина
            'aspectRatio' => 4/3,                                      // установите соотношение сторон рамки обрезки. По умолчанию свободное отношение.
            'strict' => true,                                          // true - рамка не может вызодить за холст, false - может
            'guides' => true,                                           // показывать пунктирные линии в рамке
            'center' => true,                                           // показывать центр в рамке изображения изображения
            'autoCrop' => true,                                         // показывать рамку обрезки при загрузке
            'autoCropArea' => 1,                                      // площидь рамки на холсте изображения при autoCrop (1 = 100% - 0 - 0%)
            'dragCrop' => true,                                         // создание новой рамки при клики в свободное место хоста (false - нельзя)
            'movable' => true,                                          // перемещать изображение холста (false - нельзя)
            'rotatable' => true,                                        // позволяет вращать изображение
            'scalable' => true,                                         // мастабирование изображения
            'zoomable' => false,
        ]]);
    ?>

    <div class="col-md-12" style="margin-top: 40px;">
        <?php Pjax::begin(['id' => 'pjaxBlock']); ?>
        <?php
        BootstrapSelectAsset::register($this);
        ?>
        <?php $form = ActiveForm::begin([
            'id' => 'form',
            'action' => Url::to(['step-two', 'id' => $model->id]),
            'options' => ['data-pjax' => true]]); ?>


        <div class="col-md-12" style="margin-bottom: 40px;">
            <h3>Дополнительные сведения</h3>
        <?php
        if ($model->id_car_model):
            //d($model->id_car_generation);
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
                <?= $form->field($model, 'id_car_generation')->dropDownList($model->generationList, [
                'class'     => 'form-control selectpicker',
                //'disabled'  => $model->id_car_generation ? true : false,
                'data' => [
                    'style' => 'btn-primary',
                    'live-search' => 'true',
                    'size' => 10,
                    'title' => $model->getAttributeLabel('id_car_generation')
                ],
                'onchange' => '
            var id = $(this).val();
            $.pjax({
                type: "POST",
                url: "'.Url::to(['/car/feed/select-generation?id=']).'" + id,
                data: jQuery("#form").serialize(),
                container: "#pjaxBlock",
                push: false,
                scrollTo: false
            })'
            ]); ?>
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
                <?= $form->field($model, 'id_car_serie')->dropDownList($model->serieList, [
                'class'     => 'form-control selectpicker',
                //'disabled'  => $model->id_car_serie ? true : false,
                'data' => [
                    'style' => 'btn-primary',
                    'live-search' => 'true',
                    'size' => 10,
                    'title' => $model->getAttributeLabel('id_car_serie')
                ],
                'onchange' => '
            var id = $(this).val();
            $.pjax({
                type: "POST",
                url: "'.Url::to(['/car/feed/select-serie?id=']).'" + id, 
                data: jQuery("#form").serialize(),
                container: "#pjaxBlock",
                push: false,
                scrollTo: false
            })'
            ]); ?>
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
                <?= $form->field($model, 'id_car_modification')->dropDownList($model->modificationList, [
                'class'     => 'form-control selectpicker',
                //'disabled'  => $model->id_car_modification ? true : false,
                'data' => [
                    'style' => 'btn-primary',
                    'live-search' => 'true',
                    'size' => 10,
                    'title' => $model->getAttributeLabel('id_car_modification')
                ],
                'onchange' => '
            var id = $(this).val();
            $.pjax({
                type: "POST",
                url: "'.Url::to(['/car/feed/select-modification?id=']).'" + id, 
                data: jQuery("#form").serialize(),
                container: "#pjaxBlock",
                push: false,
                scrollTo: false
            })'
            ]); ?>
                <?php
            endif;
            ?>
            <?php
        endif;
        ?>
        </div>

        <div class="col-md-2">
            <?= $form->field($model, 'power_ptc')
                ->textInput(['placeholder' => $model->getAttributeLabel('power_ptc')]) ?>
        </div>

        <div class="col-md-4">
            <?= $form->field($model, 'vin')
                ->textInput(['placeholder' => $model->getAttributeLabel('vin')]) ?>
        </div>

        <div class="col-md-4">
            <?= $form->field($model, 'num_reg')
                ->textInput(['placeholder' => $model->getAttributeLabel('num_reg')]) ?>
        </div>

        <div class="col-md-12">
            <?= $form->field($model, 'desc')
                ->textarea(['placeholder' => $model->getAttributeLabel('desc'), 'rows' => '6']) ?>
        </div>

        <div class="col-md-3">
            <?= $form->field($model, 'mileage_rus', ['checkboxTemplate' => '<div class="checkbox-default checkbox">{input}{label}</div>'])
                ->checkbox([]) ?>
        </div>

        <div class="col-md-3">
            <?= $form->field($model, 'doc', ['checkboxTemplate' => '<div class="checkbox-default checkbox">{input}{label}</div>'])
                ->checkbox(['class' => 'checkbox-primary checkbox']) ?>
        </div>

        <div class="col-md-3">
            <?= $form->field($model, 'broken', ['checkboxTemplate' => '<div class="checkbox-default checkbox">{input}{label}</div>'])
                ->checkbox(['class' => 'checkbox-primary checkbox']) ?>
        </div>

        <div class="col-md-3">
            <?= $form->field($model, 'work', ['checkboxTemplate' => '<div class="checkbox-default checkbox">{input}{label}</div>'])
                ->checkbox(['class' => 'checkbox-primary checkbox']) ?>
        </div>

        <div class="col-md-3">
            <?= $form->field($model, 'state')->dropDownList($model->stateList, [
                'class'     => 'form-control selectpicker',
                //'disabled'  => $model->id_car_model ? true : false,
                'data' => [
                    'style' => 'btn-primary',
                    //'live-search' => 'true',
                    'size' => 10,
                    'title' => $model->getAttributeLabel('state')
                ],
            ]); ?>
        </div>
<?php    
$userModel = Yii::$app->user->identity;
if ($userModel->addprofiles == 1) {?>
        <div class="col-md-3">
            <?= $form->field($model, 'profile_id')->dropDownList($profiles_items, [
                'class'     => 'form-control selectpicker',
                'prompt' => 'По умолчанию',
                'data' => [
                    'style' => 'btn-primary',
                    'size' => 10,
                ],
            ]); ?>
        </div>
<?php   }?>
        <div class="clearfix"></div>

        <div class="col-md-3">
            <?= $form->field($model, 'price', ['template' => '{label}<div class="input-group">{input}
                            <span class="input-group-addon"><span class="glyphicon glyphicon-rub"></span></span>
                         </div><i>{hint}</i>{error}'])
                ->textInput(['placeholder' => $model->getAttributeLabel('price')]) ?>
        </div>

        <div class="clearfix"></div>

        <div class="col-md-4">
            <?= $form->field($model, 'city')->widget(CityField::className(),['country' => 185/*'typeahead' => false*/]) ?>
            <?/*= $form->field($model, 'city_id')
                ->textInput(['placeholder' => $model->getAttributeLabel('city_id')]) */?>
        </div>

        <div class="clearfix"></div>

        <div class="col-md-12">
            <?= $form->field($model, 'address')
                ->textInput(['placeholder' => $model->getAttributeLabel('address')]) ?>
        </div>

        <div class="clearfix"></div>

        <div class="col-md-3">
            <?= $form->field($model, 'exchange', ['checkboxTemplate' => '<div class="checkbox-default checkbox">{input}{label}</div>'])
                ->checkbox(['class' => 'checkbox-primary checkbox']) ?>
        </div>

        <div class="col-md-12 select-color">
            <?= $form->field($model, 'color')->radioList($model->colorList,
                [
                    'item' => function($index, $label, $name, $checked, $value) {
                        if ($checked) {
                            $return = '<label class="radio-color '.$value.'">';
                            $return .= '<input type="radio" name="' . $name . '" value="' . $value . '" tabindex="3" checked="'.$checked.'">';
                            $return .= '<div><span class="color-plus"><i class="fa fa-check" aria-hidden="true"></i></span></div>';
                            $return .= '</label>';
                        } else {
                            $return = '<label class="radio-color '.$value.'">';
                            $return .= '<input type="radio" name="' . $name . '" value="' . $value . '" tabindex="3">';
                            $return .= '<div><span class="color-plus"><i class="fa fa-check" aria-hidden="true"></i></span></div>';
                            $return .= '</label>';
                        }
                        return $return;
                    },
                    'radioTemplate' => "<div class=\"radio\">\n{beginLabel}\n{input}\n{labelTitle}\n{endLabel}\n{error}\n{hint}\n</div>"
                ]) ?>
        </div>

        <?= Html::hiddenInput('model', 'common\models\forms\AdsForm') ?>
        <?= Html::hiddenInput('scenario', $model->scenario) ?>
        <?= Html::hiddenInput('form', '@frontend/modules/car/views/feed/step2') ?>
        <?= $form->field($model, 'id')->hiddenInput()->label(false) ?>

        <div class="col-md-12">
            <div class="form-group text-center">
                <?= Html::submitButton('Далее', ['class' => 'btn btn-warning']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
        <?php
        Pjax::end();
        ?>
    </div>
</div>

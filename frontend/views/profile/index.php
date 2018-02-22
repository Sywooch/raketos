<?php
/**
 * Created by PhpStorm.
 * User: Raketos - http://raketos.ru
 * Date: 10.02.2017
 * Time: 10:01
 */
//use bookin\aws\checkbox\AwesomeCheckbox;
use phpnt\cropper\ImageLoadWidget;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\bootstrap\Html;
use yii\widgets\MaskedInput;
use yii\widgets\ListView;
use phpnt\bootstrapNotify\BootstrapNotify;
use yii\widgets\Pjax;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $searchModel common\models\search\AdsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/**
 * @var $model \common\models\forms\UserForm ;
 */
?>
<?= BootstrapNotify::widget() ?>
<div class="col-md-3 text-center">
    <?= ImageLoadWidget::widget([
        'id' => 'load-user-avatar',                                     // суффикс ID
        'object_id' => $model->id,                                  // ID объекта
        'imagesObject' => $model->imagesMain,                      // уже загруженные изображения
        'images_num' => 1,                                              // максимальное количество изображений
        'images_label' => $model->image_main,                       // метка для изображения
        'imageSmallWidth' => 750,                                       // ширина миниатюры
        'imageSmallHeight' => 750,                                      // высота миниатюры
        'imagePath' => '/uploads/avatars/',                             // путь, куда будут записыватся изображения относительно алиаса
        'noImage' => 2,                                                 // 1 - no-logo, 2 - no-avatar, 3 - no-img или путь к другой картинке
        'buttonClass'=> 'btm btn-primary',                                 // класс кнопки "обновить аватар"/"загрузить аватар" / по умолчанию btm btn-info
        'previewSize'=> 'file',                                         // размер изображения для превью(либо file_small, либо просто file)
        'pluginOptions' => [                                            // настройки плагина
            'aspectRatio' => 1/1,                                       // установите соотношение сторон рамки обрезки. По умолчанию свободное отношение.
            'strict' => false,                                          // true - рамка не может вызодить за холст, false - может
            'guides' => true,                                           // показывать пунктирные линии в рамке
            'center' => true,                                           // показывать центр в рамке изображения изображения
            'autoCrop' => true,                                         // показывать рамку обрезки при загрузке
            'autoCropArea' => 0.5,                                      // площидь рамки на холсте изображения при autoCrop (1 = 100% - 0 - 0%)
            'dragCrop' => true,                                         // создание новой рамки при клики в свободное место хоста (false - нельзя)
            'movable' => true,                                          // перемещать изображение холста (false - нельзя)
            'rotatable' => true,                                        // позволяет вращать изображение
            'scalable' => true,                                         // мастабирование изображения
            'zoomable' => false,
        ],
        'classesWidget' => [
            'imageClass' => 'imageLoaderClass',
            'buttonDeleteClass' => 'btn btn-xs btn-danger btn-imageDelete glyphicon glyphicon-trash glyphicon',
            'imageContainerClass' => 'col-md-12',
            'formImagesContainerClass' => 'formImageContainer',
        ]
    ]);
    ?>
    <div class="col-md-12">
        <?= Html::a('Мои объявления', Url::to(['/users-car/search',
            'AdsSearch' => ['user_id' => Yii::$app->user->id]]),
            ['class' => 'btn btn-primary', 'style' => 'width: 100%']) ?>
    </div>
</div>
<div class="col-md-9">
    <div class="row">
        <div class="col-md-12 text-left">
            <h1>Профиль пользователя</h1>
        </div>
        <?php $form = ActiveForm::begin([
            'action' => Url::to(['/profile/update']),
            'fieldConfig' => [
                'template' => '{label}<div class="input-group">{input}
                            <span class="input-group-addon"><i class="fa fa-{font-awesome}"></i></span>
                         </div><i>{hint}</i>{error}'
            ],
            'options' => ['data-pjax' => true]
        ]); ?>
        <div class="box-body" style="margin-top: 30px;">

            <div class="col-md-4">
                <?= $form->field($model, 'first_name', ['parts' => ['{font-awesome}' => 'user']])
                    ->textInput(['placeholder' => $model->getAttributeLabel('first_name')]) ?>
            </div>

            <div class="col-md-4">
                <?= $form->field($model, 'last_name', ['parts' => ['{font-awesome}' => 'user']])
                    ->textInput(['placeholder' => $model->getAttributeLabel('last_name')]) ?>
            </div>

            <div class="col-md-4">
                <?= $form->field($model, 'middle_name', ['parts' => ['{font-awesome}' => 'user']])
                    ->textInput(['placeholder' => $model->getAttributeLabel('middle_name')]) ?>
            </div>

            <div class="col-md-12 text-left">
                    <?= $form->field($model, 'email', ['parts' => ['{font-awesome}' => 'user']])
                    ->textInput(['placeholder' => $model->getAttributeLabel('email')]) ?>
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
                             
            <div class="col-md-12 text-left">
                <h3>Сменить пароль</h3>
            </div>

            <div class="col-md-12 text-left">
                <?= $form->field($model, 'old_password', ['parts' => ['{font-awesome}' => 'lock']])
                    ->passwordInput(['placeholder' => $model->getAttributeLabel('old_password')]) ?>
            </div>

            <div class="col-md-12 text-left">
                <?= $form->field($model, 'password', ['parts' => ['{font-awesome}' => 'lock']])
                    ->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>
            </div>

            <div class="col-md-12 text-left">
                <?= $form->field($model, 'confirm_password', ['parts' => ['{font-awesome}' => 'lock']])
                    ->passwordInput(['placeholder' => $model->getAttributeLabel('confirm_password')]) ?>
            </div>

            <div class="col-md-12 text-center">
                <div class="form-group">
                    <?= Html::submitButton(Yii::t('app', 'Сохранить'), ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>
            </div>

        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
<?php
if (isset($dataProvider)):
    ?>
    <div class="col-md-12" style="margin-top: 60px;">
        <h1>Мои объявления</h1>
        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'id' => 'my-listview-id',
            'summary'=>'',
            'pager' => [
                // Customzing options for pager container tag
                'options' => [
                    //'tag' => 'div',
                    'class' => 'col-md-12 pagination text-center',
                    'style' => 'padding-left: 25px;',
                ],
            ],
            'itemView' => function ($model, $key, $index, $widget) {
                /* $var $model AdsExtend */
                return $this->render('_item-user' ,[
                    'model' => $model,
                    'key' => $key,
                    'index' => $index,
                    'widget' => $widget
                ]);
            },
        ]); ?>
    </div>

    <?php
endif;
?>
<?php
if (isset($profileDataProvider) && $model->addprofiles == 1):
    ?>
   <div class="col-md-12" style="margin-top: 60px;">
      
        <h1>Дополнительные профили</h1>
    <p>
        <?= Html::a('Create Profile', ['profiles/create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $profileDataProvider,
        'summary' => false,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'id',
          //  'user_id',
            'name',
            'phone',

              [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{view} {update} {delete} ',
            'buttons' => [
                'view' => function ($url,$model,$key) {
                    return Html::a(
                    '<span class="glyphicon glyphicon-eye-open"></span>', 
                    '/profiles/view?id='.$key);
                },
                'update' => function ($url,$model,$key) {
                    return Html::a(
                    '<span class="glyphicon glyphicon-pencil"></span>', 
                    '/profiles/update?id='.$key);
                },
                'delete' => function ($url,$model,$key) {
                    return Html::a(
                    '<span class="glyphicon glyphicon-trash"></span>', 
                    '/profiles/delete?id='.$key);
                },
////                'link' => function ($url,$model,$key) {
////                    return Html::a('Действие', $url);
////                },
            ],
        ],
        ],
    ]); ?>
<?php Pjax::end(); ?>
    </div>
    <?php
endif;
?>
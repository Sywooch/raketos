<?php
/**
 * Created by PhpStorm.
 * User: Raketos - http://raketos.ru
 * Date: 18.10.2016
 * Time: 14:41
 */

use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $idModal string */
/* @var $model \common\models\forms\CarModelForm */
?>
<?php
//dd($model);
?>
<?php
$header = $model->isNewRecord ? Yii::t('app', 'Добавить модель') : Yii::t('app', 'Изменить модель');
Modal::begin([
    'size' => 'modal-md',
    'header' => '<h1 class="text-center">'.$header.'</h1>',
    'toggleButton' => false,
    'id' => $idModal,
    'options' => [
    'tabindex' => false
    ],
    ]);
    ?>
<?= $this->render('_form', ['model' => $model, 'key' => isset($key) ? $key : '']) ?>
<?php Modal::end(); ?>
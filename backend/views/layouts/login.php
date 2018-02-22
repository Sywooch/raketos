<?php
/**
 * Created by PhpStorm.
 * User: Raketos - http://raketos.ru
 * Date: 01.12.2016
 * Time: 12:29
 */
use backend\assets\AppAsset;
use yii\helpers\Html;
use phpnt\fontAwesome\FontAwesomeAsset;
use phpnt\animateCss\AnimateCssAsset;

/* @var $this \yii\web\View */
/* @var $content string */
/* @var $user \common\models\Identity */

AppAsset::register($this);
AnimateCssAsset::register($this);
FontAwesomeAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="gray-bg">
<?php $this->beginBody() ?>
<div class="middle-box text-center loginscreen animated fadeInDown">
    <?= $content ?>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

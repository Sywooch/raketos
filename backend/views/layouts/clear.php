<?php
/**
 * Created by PhpStorm.
 * User: Raketos - http://raketos.ru
 * Date: 16.04.2017
 * Time: 12:32
 */
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */
/* @var $user \common\models\Identity */
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
<body class="pace-done">
<?php $this->beginBody() ?>
    <?= $content; ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

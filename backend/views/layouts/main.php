<?php
/**
 * Created by PhpStorm.
 * User: Raketos - http://raketos.ru
 * Date: 04.07.2016
 * Time: 11:32
 */
use backend\assets\AppAsset;
use phpnt\animateCss\AnimateCssAsset;
use yii\helpers\Html;
use phpnt\fontAwesome\FontAwesomeAsset;
use common\widgets\MetisMenu\MetisMenuAsset;
use common\widgets\SlimScroll\SlimScrollAsset;
use common\widgets\Pace\PaceAsset;
use yii\bootstrap\BootstrapPluginAsset;

/* @var $this \yii\web\View */
/* @var $content string */
/* @var $user \common\models\Identity */

/*MetisMenuAsset::register($this);
SlimScrollAsset::register($this);*/
AppAsset::register($this);
PaceAsset::register($this);
FontAwesomeAsset::register($this);
AnimateCssAsset::register($this);


if (!Yii::$app->user->isGuest) {
    $user = Yii::$app->user->identity;
    $username   = $user->username;
//$avatar     = $user->image ? Yii::$app->params['frontendUrl'].'/'.$user->image : Yii::$app->params['frontendUrl'].'/attach/images/no-avatar.png';
    $avatar     = Yii::$app->urlManager->baseUrl.'/images/no-avatar.png';
}
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
<?php /* полоса обновления страницы */ ?>
<div class="pace  pace-inactive">
    <div class="pace-progress" data-progress-text="100%" data-progress="99" style="transform: translate3d(100%, 0px, 0px);">
        <div class="pace-progress-inner"></div>
    </div>
    <div class="pace-activity"></div>
</div>

<div id="wrapper">
    <?php if (!Yii::$app->user->isGuest): ?>

        <?= $this->render('left',
            [
                'user'          => $user,
                'username'      => $username,
                'avatar'        => $avatar
            ]); ?>
    <?php endif; ?>

    <?= $this->render('content',
        [
            'content'       => $content,
            'user'          => $user,
            'username'      => $username,
            'avatar'        => $avatar
        ]); ?>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

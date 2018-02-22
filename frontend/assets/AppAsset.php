<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/items.css',
        'css/main.css',
        'css/site.css',
        'css/style.css',
        'css/temp-style.css',
        'css/blocks-style.css',
        'css/bootstrap-extend.css',
        'css/ion.rangeSlider.skinRaketos.css',
        'css/top100.css',
        'css/slick-raketos.css',
        'css/add-advert.css',
    ];
    public $js = [
        'js/inspinia.js',
        'js/main.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        'common\widgets\SlimScroll\SlimScrollAsset',
        'common\widgets\MetisMenu\MetisMenuAsset',
        'phpnt\animateCss\AnimateCssAsset',
        'phpnt\wow\WowAsset',
        'phpnt\fontAwesome\FontAwesomeAsset'
    ];
}


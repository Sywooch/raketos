<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/main.css',
        'css/site.css',
        'css/style.css',
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
    ];
}

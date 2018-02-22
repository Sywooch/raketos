<?php
/**
 * Created by PhpStorm.
 * User: Raketos - http://raketos.ru
 * Date: 09.02.2017
 * Time: 10:14
 */

namespace frontend\assets;


use yii\web\AssetBundle;

class SecondMenuAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
        'js/secondmenu.js'
    ];
    public $depends = [
    ];
}
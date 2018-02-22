<?php
/**
 * Created by PhpStorm.
 * User: Raketos - http://raketos.ru
 * Date: 28.03.2017
 * Time: 21:16
 */

namespace frontend\assets;


use yii\web\AssetBundle;

class SlickAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/ion.rangeSlider.skinRaketos.css',
        'css/top100.css',
        'css/slick-raketos.css'
    ];
    public $js = [
    ];

    public $depends = [
    ];
}
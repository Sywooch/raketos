<?php
/**
 * Created by PhpStorm.
 * User: Raketos - http://raketos.ru
 * Date: 22.04.2016
 * Time: 13:47
 */

namespace common\widgets\SlimScroll;

use yii\web\AssetBundle;

/**
 * Class AssetBundle
 * @package rmrevin\yii\fontawesome
 */
class SlimScrollAsset extends AssetBundle
{
    /**
     * @inherit
     */
    public $sourcePath = '@bower/slimscroll';

    /**
     * @inherit
     */
    public $css = [

    ];

    /**
     * @inherit
     */
    public $js = [
        'jquery.slimscroll.min.js',
    ];

    public function init()
    {
        parent::init();
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: Raketos - http://raketos.ru
 * Date: 22.04.2016
 * Time: 13:47
 */

namespace common\widgets\Pace;

use yii\web\AssetBundle;

/**
 * Class AssetBundle
 * @package rmrevin\yii\fontawesome
 */
class PaceAsset extends AssetBundle
{
    /**
     * @inherit
     */
    public $sourcePath = '@bower/pace';

    /**
     * @inherit
     */ 
    public $css = [

    ];

    /**
     * @inherit
     */
    public $js = [
        'pace.min.js',
    ];

    public function init()
    {
        parent::init();
    }
}
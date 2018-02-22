<?php
/**
 * Created by PhpStorm.
 * User: Raketos - http://raketos.ru
 * Date: 22.04.2016
 * Time: 13:47
 */

namespace common\widgets\MetisMenu;

use yii\web\AssetBundle;

/**
 * Class AssetBundle
  */
class MetisMenuAsset extends AssetBundle
{
    /**
     * @inherit
     */
    public $sourcePath = '@bower/metismenu';

    /**
     * @inherit
     */
    public $css = [
        'dist/metisMenu.min.css'
    ];

    /**
     * @inherit
     */
    public $js = [
        'dist/metisMenu.min.js'
    ];

    public function init()
    {
        parent::init();
    }
}
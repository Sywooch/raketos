<?php

/**
 * Created by PhpStorm.
 * User: Raketos - http://raketos.ru
 * Date: 27.03.2017
 * Time: 19:55
 */

namespace common\widgets\RangeSlider;

use yii\web\AssetBundle;

class RangeSliderAsset extends AssetBundle
{
    /**
     * @inherit
     */
    public $sourcePath = '@bower/ion.rangeslider';

    /**
     * @inherit
     */
    public $css = [
        'css/ion.rangeSlider.css',
    ];

    /**
     * @inherit
     */
    public $js = [
        'js/ion.rangeSlider.min.js',
    ];

    public function init()
    {
        $this->registerJs();
        parent::init();
    }

    protected function registerJs()
    {
        $js = <<<SCRIPT
            $("#range").ionRangeSlider({
            type: "double",
                min: 10000,
                max: 5000000,
                from: 200000,
                to: 3000000,
                step: 100,
                grid: false,
            onFinish: function (data) {
                if($( ".irs-to" ).text() == '5 000 000') {
                    $(".irs-to").text("5 000 000+");
                };
            },    
                        });
SCRIPT;
        \Yii::$app->view->registerJs($js);
    }
}
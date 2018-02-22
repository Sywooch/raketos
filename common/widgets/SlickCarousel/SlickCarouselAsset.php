<?php
/**
 * Created by PhpStorm.
 * User: Raketos - http://raketos.ru
 * Date: 28.03.2017
 * Time: 15:51
 */

namespace common\widgets\SlickCarousel;

use yii\web\AssetBundle;

class SlickCarouselAsset extends AssetBundle
{
    /**
     * @inherit
     */
    public $sourcePath = '@bower/slick-carousel/slick';

    /**
     * @inherit
     */
    public $css = [
        'slick.css',
    ];

    /**
     * @inherit
     */
    public $js = [
        'slick.min.js',
    ];

    public $img = [
        'ajax-loader.gif'
    ];

    public function init()
    {
        $this->registerJs();
        parent::init();
    }

    protected function registerJs()
    {
        $js = <<<SCRIPT
            $(".carousel-slick").slick({
                centerMode: true
                , infinite: false
                , slidesToShow: 3
                , slidesToScroll: 1
                , speed: 300
                , dots: false
                , variableWidth: false
                , responsive: [
                    {
                        breakpoint: 1200
                        , settings: {
                            centerMode: true
                            , slidesToScroll: 1
                            , slidesToShow: 2
                        }
                    },
                    {
                        breakpoint: 1024
                        , settings: {
                            centerMode: true
                            , slidesToScroll: 1
                            , slidesToShow: 2
                        }
                    }, 
                    {
                        breakpoint: 750
                        , settings: {
                            centerMode: true
                            , slidesToScroll: 1
                            , slidesToShow: 1
                        }
                    }
                    , {
                        breakpoint: 600
                        , settings: {
                            centerMode: true
                            , slidesToScroll: 1
                            , slidesToShow: 1
                        }
                    }
                    , {
                        breakpoint: 0
                        , settings: {
                            centerMode: true
                            , slidesToScroll: 1
                            , slidesToShow: 1
                        }
                    }

            ]
            });
SCRIPT;
        \Yii::$app->view->registerJs($js);
    }
}
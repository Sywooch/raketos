<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 08.02.2016
 * Time: 13:01
 */

namespace common\widgets\StepsNavigation;

use yii\base\Widget;
use common\widgets\StepsNavigation\assets\StepsAsset;
use yii\web\View;

class StepsNavigation extends Widget
{
    public $targetStep1 = '';
    /* Содержание */
    public $titleStep1;
    public $titleStep2;
    public $titleStep3;
    public $headerStep1;
    public $headerStep2;
    public $headerStep3;
    public $contentStep1;
    public $contentStep2;
    public $contentStep3;
    /* Стили (классы) */
    public $classLinkStep1;
    public $classLinkStep2;
    public $classLinkStep3;
    public $classContentStep1;
    public $classContentStep2;
    public $classContentStep3;
    /* ссылки */
    public $urlStep1;
    public $urlStep2;
    public $urlStep3;

    public $confirm = 'Your ad is not added. Would you like to create another ad?';

    public function init()
    {
        parent::init();
        $this->registerClientScript();
    }

    public function run()
    {
        return $this->render(
            'steps',
            [
                'widget' => $this,
            ]);
    }

    public function registerClientScript()
    {
        $this->confirm = \Yii::t('app', $this->confirm);
        $view = $this->getView();
        // Регистрация виджета
        StepsAsset::register($view);

        $js = <<< JS
            function  comeHere(id) {
                if($(id).attr('id') == "linkStep1" && $(id).attr('class') == '') {
                    window.location.replace("$this->urlStep1");
                }
                if($(id).attr('id') == "linkStep2" && $(id).attr('class') == '') {
                    window.location.replace("$this->urlStep2");
                }
                if($(id).attr('id') == "linkStep3" && $(id).attr('class') == '') {
                    window.location.replace("$this->urlStep3");
                }
            };
JS;
        $view->registerJs($js, View::POS_HEAD);

        $js = <<< JS
        $(document).ready(function () {
            //Initialize tooltips
            $('.nav-tabs > li a[title]').tooltip();
            //Wizard
            $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {
                var target = $(e.target);
                if (target.parent().hasClass('disabled')) {
                    return false;
                }
            });
        });

        function comeHere(id) {
            if($(id).attr('id') == "linkStep1" && $(id).attr('class') == '') {
                window.location.replace("$this->urlStep1");
            }
            if($(id).attr('id') == "linkStep2" && $(id).attr('class') == '') {
                window.location.replace("$this->urlStep2");
            }
            if($(id).attr('id') == "linkStep3" && $(id).attr('class') == '') {
                window.location.replace("$this->urlStep3");
            }
        }
JS;
        $view->registerJs($js);
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: Raketos - http://raketos.ru
 * Date: 27.03.2017
 * Time: 15:13
 */

namespace common\widgets\Forms;

use common\models\extend\GeoCityExtend;
use dosamigos\typeahead\Bloodhound;
use phpnt\bootstrapSelect\BootstrapSelectAsset;
use yii\bootstrap\Html;
use Yii;
use yii\bootstrap\InputWidget;
use yii\helpers\Url;
use dosamigos\typeahead\TypeAhead;

class CityMainField extends InputWidget
{
    public $class = 'form-control selectpicker';
    public $style = 'btn-primary';

    public $idForm      = '#form';
    public $idContainer = '#pjaxBlock';

    public $country;

    public $typeahead = true;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $model = $this->model;
        $cityName = '';
        if (isset(Yii::$app->geoData->city)) {
            $this->model[$this->attribute] = Yii::$app->geoData->city;
        }

        if ($this->model[$this->attribute] != null) {
            $model = GeoCityExtend::findOne($this->model[$this->attribute]);
            if ($model) $cityName = $model->name_ru;          
        } else {
            if (isset(Yii::$app->geoData->city) && ($this->country == Yii::$app->geoData->country)) {
                $model = GeoCityExtend::findOne(Yii::$app->geoData->city);
                if ($model) $cityName = $model->name_ru;
            } 
        }

        if ($this->typeahead) {
            $engine = new Bloodhound([
                'name' => 'countriesEngine',
                'clientOptions' => [
                    'datumTokenizer' => new \yii\web\JsExpression("Bloodhound.tokenizers.obj.whitespace('name')"),
                    'queryTokenizer' => new \yii\web\JsExpression("Bloodhound.tokenizers.whitespace"),
                    'remote' => [
                        'url' => Url::to(['/geo/set-city', 'id'=> $this->country, 'q'=>'QRY']),
                        'wildcard' => 'QRY'
                    ]
                ]
            ]);

            if ($this->country != null || $cityName != '') {
                echo TypeAhead::widget([
                    'name' => 'countriesEngine',
                    'value' => '',
                    'options' => ['class' => 'form-control'],
                    'engines' => [ $engine ],
                    'clientOptions' => [
                        'highlight' => true,
                        'minLength' => 2,
                    ],
                    'clientEvents' => [
                        'typeahead:selected' => new \yii\web\JsExpression(
                            'function(obj, datum, name) {  
                        window.location.replace("'.Yii::$app->params['frontendUrl'].'" + datum.id);
                    }'
                        ),
                    ],
                    'dataSets' => [
                        [
                            'name' => 'city',
                            'displayKey' => 'city',
                            'source' => $engine->getAdapterScript(),
                            'templates' => [
                                'suggestion' => new \yii\web\JsExpression("function(data){ return '<div class=\"col-xs-12 item-container\"><div class=\"item-header\">' + data.city + '</div><div class=\"item-hint\">' + data.region + '</div></div>'; }"),
                            ],
                        ]
                    ]
                ]);
            }
        }
    }

    public function registerClientScript()
    {
        $view = $this->getView();
        BootstrapSelectAsset::register($view);
    }
}
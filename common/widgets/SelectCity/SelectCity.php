<?php
/**
 * Created by PhpStorm.
 * User: Raketos - http://raketos.ru
 * Date: 07.02.2017
 * Time: 9:42
 */

namespace common\widgets\SelectCity;

use common\models\extend\GeoCityExtend;
use common\models\forms\SelectCityForm;
use common\models\GeoCity;
use Yii;
use yii\base\Widget;

class SelectCity extends Widget
{
    public $data;
    public $model;
    public $city_name;
    public $citySessionKey = '_cityUrl';
    public $cityCookieKey = '_cityUrl';
    public $cookieDuration      = 2592000;

    public function init()
    {
        parent::init();
        $this->data = Yii::$app->geoData->data;
        $this->model = new SelectCityForm();
    }

    public function run() {
        $citySession = \Yii::$app->session->get($this->citySessionKey);
        $cityCookie = \Yii::$app->request->cookies->getValue($this->cityCookieKey);
        $model = false;
        if ($citySession) {
            $model = GeoCityExtend::findOne($citySession);
        }
        if (!$model) {
            if ($cityCookie) {
                $model = GeoCityExtend::findOne($cityCookie);
            }
        }
        if (!$model) {
            $model = GeoCityExtend::findOne(524901);
        }

        //dd($model);

        $this->city_name = $model->name_ru;

        return $this->render(
            'view',
            [
                'widget' => $this,
            ]);
    }
}
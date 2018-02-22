<?php
/**
 * Created by PhpStorm.
 * User: Raketos - http://raketos.ru
 * Date: 06.09.2016
 * Time: 14:51
 */

namespace frontend\controllers;

use common\models\extend\FieldExtend;
use common\models\extend\TemplateExtend;
use common\models\forms\SelectCityForm;
use common\models\forms\UserFieldForm;
use common\models\forms\UserForm;
use common\models\forms\UserTemplateForm;
use common\models\extend\GeoCityExtend;
use common\models\extend\GeoCountryExtend;
use common\models\GeoCity;
use common\models\GeoCountry;
use Yii;
use yii\helpers\Json;
use yii\web\Controller;

class GeoController extends BehaviorsController
{
    public $citySessionKey = '_cityUrl';
    public $cityCookieKey = '_cityUrl';
    public $cookieDuration      = 2592000;


    public function actionSetCity($q)
    {
        $country_id = Yii::$app->request->get()['id'];
        $modelCountry = GeoCountryExtend::findOne(185);
        //$q = ucfirst($q);
        $results = [];
        $model = GeoCityExtend::find()
            ->joinWith('region')
            ->where(['ilike', 'geo_city.name_ru', $this->mb_ucfirst($q)])
            ->andWhere(['geo_region.country' => $modelCountry->iso2])
            ->all();

        foreach ($model as $one) {
            $results[] = [
                'id'        => $one['id'],
                'city'      => $one->name_ru,
                'region'    => $one->region->name_ru,
            ];
        }
        echo Json::encode($results);
    }

    private function mb_ucfirst($string, $enc = 'UTF-8')
    {
        return mb_strtoupper(mb_substr($string, 0, 1, $enc), $enc) .
            mb_substr($string, 1, mb_strlen($string, $enc), $enc);
    }

    public function actionSelectCity()
    {
        $model = new SelectCityForm(['scenario' => 'selectCity']);
        if ($model->load(Yii::$app->request->post()) && $model->validate(['city'])) {
            /* @var $model SelectCityForm */
            if ($model->city) {
                $cookies = Yii::$app->response->cookies;
                $cityNew = $model->city;
                $cookies->add(new \yii\web\Cookie([
                    'name' => '_cityUrl',
                    'value' => $cityNew
                ]));
                $cookies = Yii::$app->response->cookies;
            }
        }

        return $this->redirect(['/524901']);
    }

    public function actionSetCityForm($q)
    {
        $country_id = Yii::$app->request->get()['id'];
        $modelCountry = GeoCountryExtend::findOne(185);
        //$q = ucfirst($q);
        $results = [];
        $model = GeoCityExtend::find()
            ->joinWith('region')
            ->where(['ilike', 'geo_city.name_ru', $this->mb_ucfirst($q)])
            ->andWhere(['geo_region.country' => $modelCountry->iso2])
            ->all();

        foreach ($model as $one) {
            $results[] = [
                'id'        => $one['id'],
                'city'      => $one->name_ru,
                'region'    => $one->region->name_ru,
            ];
        }
        echo Json::encode($results);
    }

    public function actionSetSelectedCity()
    {
        /* @var $model ProfileUserForm */
        $id = Yii::$app->request->post('id');
        $model = Yii::$app->request->post('model');
        $model = $id ? $model::findOne($id) : new $model();;
        $model->scenario = Yii::$app->request->post('scenario');
        $model->load(Yii::$app->request->post());
        $modelCity = GeoCity::findOne($model->city_id);
        $model->country_id = $modelCity->region->countryFk->id;
        return $this->render(Yii::$app->request->post('form'), ['model' => $model]);
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: Raketos - http://raketos.ru
 * Date: 21.10.2016
 * Time: 21:44
 */

namespace common\components\validators;

use common\models\forms\SelectCityForm;
use Yii;
use yii\validators\Validator;

class CityValidator extends Validator
{
    public function validateAttribute($model, $attribute)
    {
        $city = $model->city;
        $city_name = Yii::$app->request->post('countriesEngine');

        if ($city == null) {
            $this->addError($model, $attribute, \Yii::t('app', 'Город {city} не найден.', ['city' => $city_name]));
        }
        $modelGeoCityExtend = SelectCityForm::findOne($city);
        //dd($modelGeoCityExtend);
        if (!$modelGeoCityExtend)
            $this->addError($model, $attribute, \Yii::t('app', 'Город {city} не найден.', ['city' => $city_name]));
        if (Yii::$app->language == 'ru') {
            if ($modelGeoCityExtend->name_ru != $city_name) {
                $this->addError($model, $attribute, \Yii::t('app', 'Город {city} не найден.', ['city' => $city_name]));
            }
        }
    }
}
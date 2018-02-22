<?php
/**
 * Created by PhpStorm.
 * User: Raketos - http://raketos.ru
 * Date: 07.02.2017
 * Time: 12:05
 */

namespace common\models\forms;

use Yii;
use common\components\validators\CityValidator;
use common\models\extend\GeoCityExtend;

class SelectCityForm extends GeoCityExtend
{
    public $city;
    public $country;

    public function rules()
    {
        $items = GeoCityExtend::rules();
        $items[] = ['city', 'required', 'on' => 'selectCity'];
        $items[] = ['city', CityValidator::className(), 'on' => 'selectCity'];
        return $items;
    }

    public function attributeLabels()
    {
        $items = GeoCityExtend::attributeLabels();
        $items['country'] = Yii::t('app', 'Страна');
        $items['city'] = Yii::t('app', 'Город');
        return $items;
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: Raketos - http://raketos.ru
 * Date: 12.09.2016
 * Time: 14:56
 */

namespace common\models\extend;

use common\models\Address;
use common\models\GeoCity;
use common\models\GeoCountry;
use common\models\GeoRegion;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * @property string $cityName
 * @property array $citiesList
 *
 */
class GeoCityExtend extends GeoCity
{
    public $country_id;
    public $city;
    public $city_id;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['region_id', 'country_id', 'city_id'], 'integer'],
            [['name_ru', 'name_en', 'lat', 'lon'], 'required'],
            [['lat', 'lon'], 'number'],
            [['name_ru', 'name_en'], 'string', 'max' => 128],
            [['okato'], 'string', 'max' => 20],
            [['active'], 'boolean'],
        ];
    }

    public function attributeLabels()
    {
        $model =  new GeoCity();
        $labels = $model->attributeLabels();
        $model =  new GeoRegion();
        $labels += $model->attributeLabels();
        $model =  new GeoCountry();
        $labels += $model->attributeLabels();
        $labels += [
            'country_id'      => Yii::t('app', 'Страна'),
            'city'              => Yii::t('app', 'Город'),
        ];
        return $labels;
    }

    public static function getCityName($city)
    {
        $model = GeoCity::findOne($city);
        if (\Yii::$app->language == 'ru') {
            return $model->name_ru;
        }

        return $model->name_en;
    }

    /**
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            return true;
        }
        return false;
    }

    /**
     * @param bool $insert
     * @param array $changedAttributes
     */
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
    }
}
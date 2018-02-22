<?php

namespace common\models;

use yii\db\Exception;
use yii\helpers\ArrayHelper;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "geo_city".
 *
 * @property integer $id
 * @property integer $region_id
 * @property string $name_ru
 * @property string $name_en
 * @property string $lat
 * @property string $lon
 * @property string $okato
 * @property boolean $active
 *
 * @property Company[] $companies
 * @property Stock[] $stocks
 * @property GeoRegion $region
 * @property City $city
 */
class GeoCity extends ActiveRecord
{
    public $country_iso;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'geo_city';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['region_id', 'id'], 'integer'],
            [['name_ru', 'name_en', 'lat', 'lon', 'okato'], 'required'],
            [['lat', 'lon'], 'number'],
            [['active'], 'boolean'],
            [['name_ru', 'name_en', 'country_iso'], 'string', 'max' => 128],
            [['okato'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => \Yii::t('app', 'ID'),
            'region_id' => \Yii::t('app', 'Регион'),
            'name_ru' => \Yii::t('app', 'Город'),
            'name_en' => \Yii::t('app', 'Name En'),
            'lat' => \Yii::t('app', 'Широта'),
            'lon' => \Yii::t('app', 'Долгота'),
            'okato' => \Yii::t('app', 'Okato'),
            'active' => \Yii::t('app', 'Active'),
            'country_iso' => \Yii::t('app', 'Страна'),
        ];
    }

    public function fields()
    {
        return [
            'id',
            'name_ru',
            'name_en',
            'lat',
            'lon',
            'region' => function () {
                return $this->region;
            },
        ];
    }

    public function getCity()
    {
        return $this->hasOne(GeoCity::className(), ['cityId' => 'id']);
    }

    public function getRegion()
    {
        return $this->hasOne(GeoRegion::className(), ['id' => 'region_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    /*public function getCity()
    {
        return $this->hasOne(GeoCity::className(), ['id' => 'city_id']);
    }*/

    public function getCountriesList()
    {
        $countries = ArrayHelper::map(
            GeoCountry::find()
                ->where(['name_ru' => 'Россия'])
                ->asArray()
                ->orderBy('name_ru')
                ->all(),
            'iso',
            'name_ru'
        );

        return $countries;
    }

    public function getRegionsList()
    {
        $regions = ArrayHelper::map(
            GeoRegion::find()
                ->where(['country' => $this->country_iso])
                ->asArray()
                ->orderBy('name_ru')
                ->all(),
            'id',
            'name_ru'
        );

        return $regions;
    }

    public function getCityList()
    {
        if ($this->id) {
            $this->region_id = $this->city->region_id;
        }
        $cities = ArrayHelper::map(
            GeoCity::find()
                ->where(['region_id' => $this->region_id])
                ->asArray()
                ->orderBy('name_ru')
                ->all(),
            'id',
            'name_ru'
        );

        return $cities;
    }

    public function getCountryIso() {
        return $this->city->region->country;
    }

    public function deleteCity($id) {
        $modelGeoCity = GeoCity::findOne($id);

        if ($modelGeoCity) {
            $modelGeoCity->active = 0;
            $transaction = \Yii::$app->db->beginTransaction();
            try {
                if ($modelGeoCity->save()):
                    /* @var $modelCompany Company */
                    $modelCity = City::findOne($modelGeoCity->id);
                    if ($modelCity->delete()) {
                        $transaction->commit();
                        return true;
                    }
                endif;
            } catch (Exception $e) {
                $transaction->rollBack();
            }
        }
        return false;
    }

    public function createCity() {
        $modelGeoCity = GeoCity::findOne($this->id);
        if ($modelGeoCity) {
            $modelGeoCity->active = 1;
            $transaction = \Yii::$app->db->beginTransaction();
            try {
                if ($modelGeoCity->save()):
                    /* @var $modelCompany Company */
                    $modelCity = new City();
                    $modelCity->cityId = $modelGeoCity->id;
                    $modelCity->city = $modelGeoCity->name_ru;
                    $modelCity->latitude = $modelGeoCity->lat;
                    $modelCity->longitude = $modelGeoCity->lon;
                    if ($modelCity->save()) {
                        $transaction->commit();
                        return true;
                    }
                endif;
            } catch (Exception $e) {
                $transaction->rollBack();
            }
        }
        return false;
    }

    public function getAllCity() {
        return self::find()
            //->select('id')
            ->where(['active' => 1])
            ->orderBy('name_ru')
            ->all();
    }
}

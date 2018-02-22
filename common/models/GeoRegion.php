<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "geo_region".
 *
 * @property integer $id
 * @property string $iso
 * @property string $country
 * @property string $name_ru
 * @property string $name_en
 * @property string $timezone
 * @property string $okato
 *
 * @property GeoRegion[] $cities
 * @property GeoCountry $country0
 */
class GeoRegion extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'geo_region';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['iso', 'country', 'name_ru', 'name_en', 'timezone', 'okato'], 'required'],
            [['iso'], 'string', 'max' => 7],
            [['country', 'okato'], 'string', 'max' => 2],
            [['name_ru', 'name_en'], 'string', 'max' => 128],
            [['timezone'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => \Yii::t('app', 'ID'),
            'iso' => \Yii::t('app', 'Iso'),
            'country' => \Yii::t('app', 'Country'),
            'name_ru' => \Yii::t('app', 'Регион'),
            'name_en' => \Yii::t('app', 'Name En'),
            'timezone' => \Yii::t('app', 'Timezone'),
            'okato' => \Yii::t('app', 'Okato'),
        ];
    }

    public function fields()
    {
        return [
            'id',
            'name_ru',
            'name_en',
            'timezone',
            'country' => function () {
                return $this->country0;
            },
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCities()
    {
        return $this->hasMany(GeoCity::className(), ['region_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry0()
    {
        return $this->hasOne(GeoCountry::className(), ['iso2' => 'country']);
    }
}

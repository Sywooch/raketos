<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "geo_country".
 *
 * @property integer $id
 * @property string $iso
 * @property string $continent
 * @property string $name_ru
 * @property string $name_en
 * @property string $lat
 * @property string $lon
 * @property string $timezone
 */
class GeoCountry extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'geo_country';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['iso', 'continent', 'name_ru', 'name_en', 'lat', 'lon', 'timezone'], 'required'],
            [['lat', 'lon'], 'number'],
            [['iso', 'continent'], 'string', 'max' => 2],
            [['name_ru', 'name_en'], 'string', 'max' => 128],
            [['timezone'], 'string', 'max' => 30],
            [['iso'], 'unique'],
        ];
    }

    public function fields()
    {
        return [
            'id',
            'name_ru',
            'name_en',
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
            'continent' => \Yii::t('app', 'Continent'),
            'name_ru' => \Yii::t('app', 'Name Ru'),
            'name_en' => \Yii::t('app', 'Name En'),
            'lat' => \Yii::t('app', 'Lat'),
            'lon' => \Yii::t('app', 'Lon'),
            'timezone' => \Yii::t('app', 'Timezone'),
        ];
    }
}

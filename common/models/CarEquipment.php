<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "car_equipment".
 *
 * @property integer $id_car_equipment
 * @property string $name
 * @property string $date_create
 * @property string $date_update
 * @property integer $id_car_modification
 * @property integer $price_min
 * @property integer $id_car_type
 * @property integer $year
 *
 * @property CarModification $modification
 * @property CarOptionValue[] $cptionValues
 */
class CarEquipment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'car_equipment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'date_create', 'date_update', 'id_car_modification', 'id_car_type'], 'required'],
            [['date_create', 'date_update', 'id_car_modification', 'price_min', 'id_car_type', 'year'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_car_equipment' => 'id',
            'name' => 'Название',
            'date_create' => 'Date Create',
            'date_update' => 'Date Update',
            'id_car_modification' => 'Id Car Modification',
            'price_min' => 'Дилерская цена в рублях',
            'id_car_type' => 'Id Car Type',
            'year' => 'Год выпуска',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModification()
    {
        return $this->hasOne(CarModification::className(), ['id_car_modification' => 'id_car_modification']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOptionValues()
    {
        return $this->hasMany(CarOptionValue::className(), ['id_car_equipment' => 'id_car_equipment']);
    }
}

<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "car_characteristic_value".
 *
 * @property integer $id_car_characteristic_value
 * @property string $value
 * @property string $unit
 * @property integer $id_car_characteristic
 * @property integer $id_car_modification
 * @property string $date_create
 * @property string $date_update
 * @property integer $id_car_type
 *
 * @property CarCharacteristic $characteristic
 * @property CarModification $modification
 */
class CarCharacteristicValue extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'car_characteristic_value';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['value', 'id_car_characteristic', 'id_car_modification', 'id_car_type'], 'required'],
            [['id_car_characteristic', 'id_car_modification', 'date_create', 'date_update', 'id_car_type'], 'integer'],
            [['value', 'unit'], 'string', 'max' => 255],
            [['id_car_characteristic', 'id_car_modification'], 'unique', 'targetAttribute' => ['id_car_characteristic', 'id_car_modification'], 'message' => 'The combination of Id Car Characteristic and Id Car Modification has already been taken.'],
            [['id_car_characteristic', 'id_car_modification', 'id_car_type'], 'unique', 'targetAttribute' => ['id_car_characteristic', 'id_car_modification', 'id_car_type'], 'message' => 'The combination of Id Car Characteristic, Id Car Modification and Id Car Type has already been taken.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_car_characteristic_value' => 'Id Car Characteristic Value',
            'value' => 'Значение',
            'unit' => 'Еденица измерения',
            'id_car_characteristic' => 'Id Car Characteristic',
            'id_car_modification' => 'Id Car Modification',
            'date_create' => 'Date Create',
            'date_update' => 'Date Update',
            'id_car_type' => 'Id Car Type',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCharacteristic()
    {
        return $this->hasOne(CarCharacteristic::className(), ['id_car_characteristic' => 'id_car_characteristic']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModification()
    {
        return $this->hasOne(CarModification::className(), ['id_car_modification' => 'id_car_modification']);
    }
}

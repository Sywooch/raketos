<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "car_modification".
 *
 * @property integer $id_car_modification
 * @property integer $id_car_serie
 * @property integer $id_car_model
 * @property string $name
 * @property string $date_create
 * @property string $date_update
 * @property integer $id_car_type
 *
 * @property CarCharacteristicValue[] $characteristicValues
 * @property CarEquipment[] $equipments
 * @property CarSerie $serie
 */
class CarModification extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'car_modification';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_car_serie', 'id_car_model', 'name', 'id_car_type'], 'required'],
            [['id_car_serie', 'id_car_model', 'date_create', 'date_update', 'id_car_type'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_car_modification' => 'ID',
            'id_car_serie' => 'Id Car Serie',
            'id_car_model' => 'Id Car Model',
            'name' => 'Название модификации',
            'date_create' => 'Date Create',
            'date_update' => 'Date Update',
            'id_car_type' => 'Id Car Type',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCharacteristicValues()
    {
        return $this->hasMany(CarCharacteristicValue::className(), ['id_car_modification' => 'id_car_modification']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEquipments()
    {
        return $this->hasMany(CarEquipment::className(), ['id_car_modification' => 'id_car_modification']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSerie()
    {
        return $this->hasOne(CarSerie::className(), ['id_car_serie' => 'id_car_serie']);
    }
}

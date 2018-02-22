<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "car_characteristic".
 *
 * @property integer $id_car_characteristic
 * @property string $name
 * @property integer $id_parent
 * @property string $date_create
 * @property string $date_update
 * @property integer $id_car_type
 *
 * @property CarCharacteristicValue[] $characteristicValues
 * @property CarCharacteristic $parent
 */
class CarCharacteristic extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'car_characteristic';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_parent', 'date_create', 'date_update', 'id_car_type'], 'integer'],
            [['id_car_type'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_car_characteristic' => 'id',
            'name' => 'Название характеристики',
            'id_parent' => 'Родительская характеристика',
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
        return $this->hasMany(CarCharacteristicValue::className(), ['id_car_characteristic' => 'id_car_characteristic']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(CarCharacteristic::className(), ['id_car_characteristic' => 'id_parent']);
    }
}

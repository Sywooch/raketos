<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "car_option_value".
 *
 * @property integer $id_car_option_value
 * @property integer $is_base
 * @property integer $id_car_option
 * @property integer $id_car_equipment
 * @property string $date_create
 * @property string $date_update
 * @property integer $id_car_type
 *
 * @property CarEquipment $equipment
 * @property CarOption $option
 */
class CarOptionValue extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'car_option_value';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['is_base', 'id_car_option', 'id_car_equipment', 'date_create', 'date_update', 'id_car_type'], 'integer'],
            [['id_car_option', 'id_car_equipment', 'date_create', 'date_update', 'id_car_type'], 'required'],
            [['id_car_option', 'id_car_equipment', 'id_car_type'], 'unique', 'targetAttribute' => ['id_car_option', 'id_car_equipment', 'id_car_type'], 'message' => 'The combination of Id Car Option, Id Car Equipment and Id Car Type has already been taken.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_car_option_value' => 'Id Car Option Value',
            'is_base' => 'Базовая / Дополнительная',
            'id_car_option' => 'Id Car Option',
            'id_car_equipment' => 'Id Car Equipment',
            'date_create' => 'Date Create',
            'date_update' => 'Date Update',
            'id_car_type' => 'Id Car Type',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEquipment()
    {
        return $this->hasOne(CarEquipment::className(), ['id_car_equipment' => 'id_car_equipment']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOption()
    {
        return $this->hasOne(CarOption::className(), ['id_car_option' => 'id_car_option']);
    }
}

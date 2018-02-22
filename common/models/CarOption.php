<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "car_option".
 *
 * @property integer $id_car_option
 * @property string $name
 * @property integer $id_parent
 * @property string $date_create
 * @property string $date_update
 * @property integer $id_car_type
 *
 * @property CarOptionValue[] $optionValues
 * @property CarOption $parent
 */
class CarOption extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'car_option';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'date_create', 'date_update', 'id_car_type'], 'required'],
            [['id_parent', 'date_create', 'date_update', 'id_car_type'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_car_option' => 'Id Car Option',
            'name' => 'Название опции',
            'id_parent' => 'Родительская опция',
            'date_create' => 'Date Create',
            'date_update' => 'Date Update',
            'id_car_type' => 'Id Car Type',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOptionValues()
    {
        return $this->hasMany(CarOptionValue::className(), ['id_car_option' => 'id_car_option']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(CarOption::className(), ['id_car_option' => 'id_parent']);
    }
}

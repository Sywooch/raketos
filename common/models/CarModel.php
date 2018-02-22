<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "car_model".
 *
 * @property integer $id_car_model
 * @property integer $id_car_mark
 * @property string $name
 * @property string $date_create
 * @property string $date_update
 * @property integer $id_car_type
 * @property string $name_rus
 *
 * @property CarGeneration[] $generations
 * @property CarMark $mark
 */
class CarModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'car_model';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_car_mark', 'name', 'id_car_type'], 'required'],
            [['id_car_mark', 'date_create', 'date_update', 'id_car_type'], 'integer'],
            [['name', 'name_rus'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_car_model' => 'ID',
            'id_car_mark' => 'Марка',
            'name' => 'Название модели',
            'date_create' => 'Date Create',
            'date_update' => 'Date Update',
            'id_car_type' => 'Id Car Type',
            'name_rus' => 'Название марки на русском',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGenerations()
    {
        return $this->hasMany(CarGeneration::className(), ['id_car_model' => 'id_car_model']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMark()
    {
        return $this->hasOne(CarMark::className(), ['id_car_mark' => 'id_car_mark']);
    }
}

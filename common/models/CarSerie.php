<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "car_serie".
 *
 * @property integer $id_car_serie
 * @property integer $id_car_model
 * @property string $name
 * @property string $date_create
 * @property string $date_update
 * @property integer $id_car_generation
 * @property integer $id_car_type
 *
 * @property CarGeneration $generation
 * @property CarModification[] $modifications
 */
class CarSerie extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'car_serie';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_car_model', 'name', 'id_car_type'], 'required'],
            [['id_car_model', 'date_create', 'date_update', 'id_car_generation', 'id_car_type'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_car_serie' => 'ID',
            'id_car_model' => 'Id Car Model',
            'name' => 'Название серии',
            'date_create' => 'Date Create',
            'date_update' => 'Date Update',
            'id_car_generation' => 'Id Car Generation',
            'id_car_type' => 'Id Car Type',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGeneration()
    {
        return $this->hasOne(CarGeneration::className(), ['id_car_generation' => 'id_car_generation']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModifications()
    {
        return $this->hasMany(CarModification::className(), ['id_car_serie' => 'id_car_serie']);
    }
}

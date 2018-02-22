<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "car_generation".
 *
 * @property integer $id_car_generation
 * @property string $name
 * @property integer $id_car_model
 * @property string $year_begin
 * @property string $year_end
 * @property string $date_create
 * @property string $date_update
 * @property integer $id_car_type
 *
 * @property CarModel $model
 * @property CarSerie[] $series
 */
class CarGeneration extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'car_generation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'id_car_model', 'date_create'], 'required'],
            [['id_car_model', 'date_create', 'date_update', 'id_car_type'], 'integer'],
            [['name', 'year_begin', 'year_end'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_car_generation' => 'Id Car Generation',
            'name' => 'Название поколения',
            'id_car_model' => 'Id Car Model',
            'year_begin' => 'Год начала выпуска',
            'year_end' => 'Год окончания выпуска',
            'date_create' => 'Date Create',
            'date_update' => 'Date Update',
            'id_car_type' => 'Id Car Type',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModel()
    {
        return $this->hasOne(CarModel::className(), ['id_car_model' => 'id_car_model']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeries()
    {
        return $this->hasMany(CarSerie::className(), ['id_car_generation' => 'id_car_generation']);
    }
}

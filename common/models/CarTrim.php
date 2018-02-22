<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "car_trim".
 *
 * @property integer $id_car_trim
 * @property integer $id_car_serie
 * @property integer $id_car_model
 * @property string $name
 * @property integer $start_production_year
 * @property integer $end_production_year
 * @property integer $price_min
 * @property integer $price_max
 *
 * @property CarSerie $serie
 * @property CarModel $model
 * @property CarSpecificationValue[] $specificationValue
 */
class CarTrim extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'car_trim';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_car_serie', 'id_car_model'], 'required'],
            [['id_car_serie', 'id_car_model', 'start_production_year', 'end_production_year', 'price_min', 'price_max'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_car_trim' => 'Id Car Trim',
            'id_car_serie' => 'Id Car Serie',
            'id_car_model' => 'Id Car Model',
            'name' => 'Name',
            'start_production_year' => 'Start Production Year',
            'end_production_year' => 'End Production Year',
            'price_min' => 'Price Min',
            'price_max' => 'Price Max',
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
    public function getSerie()
    {
        return $this->hasOne(CarSerie::className(), ['id_car_serie' => 'id_car_serie']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSpecificationValue()
    {
        return $this->hasMany(CarSpecificationValue::className(), ['id_car_trim' => 'id_car_trim']);
    }
}

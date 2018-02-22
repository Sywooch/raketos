<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "car_mark".
 *
 * @property integer $id_car_mark
 * @property string $name
 * @property string $date_create
 * @property string $date_update
 * @property integer $id_car_type
 * @property string $name_rus
 *
 * @property CarModel[] $models
 * @property CarType $type
 */
class CarMark extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'car_mark';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'id_car_type'], 'required'],
            [['date_create', 'date_update', 'id_car_type'], 'integer'],
            [['name', 'name_rus'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_car_mark' => 'ID',
            'name' => 'Название марки',
            'date_create' => 'Date Create',
            'date_update' => 'Date Update',
            'id_car_type' => 'Id Car Type',
            'name_rus' => 'Название марки на русском',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModels()
    {
        return $this->hasMany(CarModel::className(), ['id_car_mark' => 'id_car_mark']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(CarType::className(), ['id_car_type' => 'id_car_type']);
    }
}

<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "car_make".
 *
 * @property integer $id_car_make
 * @property string $name
 *
 * @property CarModel[] $models
 */
class CarMake extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'car_make';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_car_make' => 'Id Car Make',
            'name' => 'Марка',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModels()
    {
        return $this->hasMany(CarModel::className(), ['id_car_make' => 'id_car_make']);
    }
}

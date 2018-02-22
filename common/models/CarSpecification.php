<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "car_specification".
 *
 * @property integer $id_car_specification
 * @property string $name
 * @property integer $id_parent
 *
 * @property CarSpecification $parent
 */
class CarSpecification extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'car_specification';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_parent'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_car_specification' => 'Id Car Specification',
            'name' => 'Название',
            'id_parent' => 'Родитель',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(CarSpecification::className(), ['id_car_specification' => 'id_parent']);
    }
}

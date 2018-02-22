<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "rating_calculate".
 *
 * @property integer $id_rating_calculate
 * @property string $mileage
 * @property string $year
 * @property string $state
 * @property string $rating
 * @property string $price
 * @property string $formula
 */
class RatingCalculate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rating_calculate';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['formula'], 'required'],
            [['mileage', 'year', 'state', 'rating', 'price'], 'string', 'max' => 1],
            [['formula'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_rating_calculate' => 'ID',
            'mileage' => 'Пробег',
            'year' => 'Год',
            'state' => 'Состояние',
            'rating' => 'Рейтинг',
            'price' => 'Цепа',
            'formula' => 'Формула',
        ];
    }
}

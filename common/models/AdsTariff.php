<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ads_tariff".
 *
 * @property integer $id
 * @property string $name
 * @property integer $period
 * @property integer $price
 *
 * @property Ads[] $ads
 */
class AdsTariff extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ads_tariff';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'period', 'price'], 'required'],
            [['period', 'price'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'period' => 'Период (кол-во дней)',
            'price' => 'Стоимость',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAds()
    {
        return $this->hasMany(Ads::className(), ['tariff_id' => 'id']);
    }
}

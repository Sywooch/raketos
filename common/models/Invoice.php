<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "invoice".
 *
 * @property integer $id
 * @property integer $sum
 * @property integer $id_ads
 * @property integer $id_tariff
 * @property integer $id_user
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Ads $idAds
 * @property AdsTariff $idTariff
 * @property User $idUser
 */
class Invoice extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'invoice';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sum', 'id_ads', 'id_tariff', 'id_user', 'status', 'created_at', 'updated_at'], 'integer'],
            [['id_ads'], 'exist', 'skipOnError' => true, 'targetClass' => Ads::className(), 'targetAttribute' => ['id_ads' => 'id']],
            [['id_tariff'], 'exist', 'skipOnError' => true, 'targetClass' => AdsTariff::className(), 'targetAttribute' => ['id_tariff' => 'id']],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sum' => 'Стоимость',
            'id_ads' => 'Объявление',
            'id_tariff' => 'Тариф',
            'id_user' => 'Пользователь',
            'status' => 'Статус',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата изменения',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdAds()
    {
        return $this->hasOne(Ads::className(), ['id' => 'id_ads']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdTariff()
    {
        return $this->hasOne(AdsTariff::className(), ['id' => 'id_tariff']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }
}

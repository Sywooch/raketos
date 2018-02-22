<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ads".
 *
 * @property integer $id
 * @property integer $id_car_mark
 * @property integer $id_car_model
 * @property integer $id_car_generation
 * @property integer $id_car_serie
 * @property integer $id_car_modification
 * @property integer $mileage
 * @property integer $power_ptc
 * @property boolean $mileage_rus
 * @property boolean $doc
 * @property boolean $broken
 * @property boolean $work
 * @property string $vin
 * @property string $num_reg
 * @property string $desc
 * @property integer $price
 * @property boolean $exchange
 * @property integer $user_id
 * @property integer $city_id
 * @property string $address
 * @property string $image_main
 * @property string $images
 * @property boolean $temp
 * @property integer $status
 * @property integer $year
 * @property string $color
 * @property integer $state
 * @property integer $rating
 * @property boolean $is_paid
 * @property integer $end_paid
 * @property integer $tariff_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property AdsTariff $tariff
 * @property CarGeneration $idCarGeneration
 * @property CarModel $idCarModel
 * @property CarModification $idCarModification
 * @property CarSerie $idCarSerie
 * @property User $user
 * @property AdsCarCharacteristic[] $adsCarCharacteristics
 * @property Invoice[] $invoices
 * @property Rating[] $ratings
 */
class Ads extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ads';
    }

    public function beforeDelete(){
        foreach($this->adsCarCharacteristics as $model)
            $model->delete();
        foreach($this->invoices as $model)
            $model->delete();
        foreach($this->ratings as $model)
            $model->delete();
        return parent::beforeDelete();
}

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['profile_id','id_car_mark', 'id_car_model', 'id_car_generation', 'id_car_serie', 'id_car_modification', 'mileage', 'power_ptc', 'price', 'user_id', 'city_id', 'status', 'year', 'state', 'rating', 'end_paid', 'tariff_id', 'created_at', 'updated_at'], 'integer'],
            [['mileage_rus', 'doc', 'broken', 'work', 'exchange', 'temp', 'is_paid'], 'boolean'],
            [['desc'], 'string'],
            [['vin', 'num_reg', 'address'], 'string', 'max' => 255],
            [['image_main', 'images'], 'string', 'max' => 20],
            [['color'], 'string', 'max' => 50],
            [['tariff_id'], 'exist', 'skipOnError' => true, 'targetClass' => AdsTariff::className(), 'targetAttribute' => ['tariff_id' => 'id']],
            [['id_car_generation'], 'exist', 'skipOnError' => true, 'targetClass' => CarGeneration::className(), 'targetAttribute' => ['id_car_generation' => 'id_car_generation']],
            [['id_car_model'], 'exist', 'skipOnError' => true, 'targetClass' => CarModel::className(), 'targetAttribute' => ['id_car_model' => 'id_car_model']],
            [['id_car_modification'], 'exist', 'skipOnError' => true, 'targetClass' => CarModification::className(), 'targetAttribute' => ['id_car_modification' => 'id_car_modification']],
            [['id_car_serie'], 'exist', 'skipOnError' => true, 'targetClass' => CarSerie::className(), 'targetAttribute' => ['id_car_serie' => 'id_car_serie']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_car_mark' => 'Марка',
            'id_car_model' => 'Модель',
            'id_car_generation' => 'Поколение',
            'id_car_serie' => 'Серия',
            'id_car_modification' => 'Модификация',
            'mileage' => 'Пробег, км',
            'power_ptc' => 'Мощность по ПТС',
            'mileage_rus' => 'С пробегом в России',
            'doc' => 'С документами',
            'broken' => 'Битый',
            'work' => 'На ходу',
            'vin' => 'VIN (номер кузова)',
            'num_reg' => 'Номер свидетельства о регистрации',
            'desc' => 'Описание',
            'price' => 'Цена',
            'exchange' => 'Возможен обмен',
            'user_id' => 'Пользователь',
            'city_id' => 'Город',
            'address' => 'Адрес или ориентир',
            'image_main' => 'Метка изображения',
            'images' => 'Метка изображения доп фото',
            'temp' => 'Временное',
            'status' => 'Статус',
            'year' => 'Год выпуска',
            'color' => 'Цвет',
            'state' => 'Состояние',
            'rating' => 'Рейтинг',
            'is_paid' => 'Платное объявление',
            'end_paid' => 'Дата окончания оплаты',
            'tariff_id' => 'Тариф',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата изменения',
            'profile_id' => 'Профиль пользователя'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTariff()
    {
        return $this->hasOne(AdsTariff::className(), ['id' => 'tariff_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCarGeneration()
    {
        return $this->hasOne(CarGeneration::className(), ['id_car_generation' => 'id_car_generation']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCarModel()
    {
        return $this->hasOne(CarModel::className(), ['id_car_model' => 'id_car_model']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCarModification()
    {
        return $this->hasOne(CarModification::className(), ['id_car_modification' => 'id_car_modification']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCarSerie()
    {
        return $this->hasOne(CarSerie::className(), ['id_car_serie' => 'id_car_serie']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdsCarCharacteristics()
    {
        return $this->hasMany(AdsCarCharacteristic::className(), ['ads_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoices()
    {
        return $this->hasMany(Invoice::className(), ['id_ads' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRatings()
    {
        return $this->hasMany(Rating::className(), ['ads_id' => 'id']);
    }
}

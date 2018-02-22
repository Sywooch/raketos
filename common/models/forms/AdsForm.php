<?php
/**
 * Created by PhpStorm.
 * User: Raketos - http://raketos.ru
 * Date: 18.03.2017
 * Time: 15:31
 */

namespace common\models\forms;


use common\models\extend\AdsExtend;
use common\models\extend\AdsTariffExtend;
use common\models\extend\UserExtend;
use yii\behaviors\TimestampBehavior;

class AdsForm extends AdsExtend
{
    public $city;

    public function rules()
    {
        $items = AdsExtend::rules();
        $items[] = ['city', 'integer'];
        $items[] = [['year', 'mileage'], 'required'];
        $items[] = [['price'], 'required', 'on' => 'step2'];
        return $items;
    }

    public function attributeLabels()
    {
        $items = AdsExtend::attributeLabels();
        $items['city'] = 'Город';
        $items['price_from'] = 'Цена';
        $items['mileage_from'] = 'Пробег, км';
        $items['year_from'] = 'Год выпуска';
        $items['power_from'] = 'Мощность дв.';
        $items['capacity_from'] = 'Объем дв.';
        $items['number_of_seats'] = 'Количество мест';
        $items['engine_type'] = 'Тип двигателя';
        $items['inlet_type'] = 'Тип впуска';
        $items['gearbox_type'] = 'Тип КПП';
        $items['fuel_grade'] = 'Марка топлива';
        $items['eco_standard'] = 'Экологический стандарт';
        $items['number_of_gears'] = 'Количество передач';
        $items['cylinder_arrangement'] = 'Расположение цилиндров';
        $items['number_of_cylinders'] = 'Количество цилиндров';
        $items['number_of_valves_per_cylinder'] = 'Количество клапанов на цилиндр';
        $items['drive_unit'] = 'Привод';
        $items['front_suspension'] = 'Передняя подвеска';
        $items['number_of_seats_from'] = 'Количество мест';
        $items['width_from'] = 'Ширина (мм)';
        $items['length_from'] = 'Длина (мм)';
        $items['height_from'] = 'Высота (мм)';
        $items['ground_clearance_from'] = 'Дорожный просвет (мм)';
        $items['wheelbase_from'] = 'Колёсная база (мм)';
        $items['track_front_from'] = 'Колея передняя (мм)';
        $items['rear_track_from'] = 'Колея задняя (мм)';
        $items['trunk_volume_min_from'] = 'Объем багажника мин. (л)';
        $items['trunk_volume_max_from'] = 'Объем багажника макс. (л)';
        $items['turnover_of_max_power_from'] = 'Обороты макс. мощ. (об/мин)';
        $items['max_torque_from'] = 'Макс. крутящий момент (Н*м)';
        $items['max_speed_from'] = 'Макс. скорость (км/ч)';
        $items['curb_weight_from'] = 'Снаряженная масса (кг)';
        $items['fuel_tank_capacity_from'] = 'Объём топливного бака (л)';
        $items['acceleration_to_100_from'] = 'Разгон до 100 км/ч (сек)';
        $items['fuel_consumption_city_for_100_from'] = 'Расход в городе на 100 км (л)';
        $items['fuel_consumption_highway_for_100_from'] = 'Расход на шоссе на 100 км (л)';
        $items['fuel_consumption_mixed_cycle_for_100_from'] = 'Расход в см. цикле на 100 км (л)';
        $items['is_picture'] = 'Только с фото';
        $items['color'] = 'Цвет';
        return $items;
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return [[
            'class' => TimestampBehavior::className(),
        ]];
    }

    public function beforeSave($insert)
    {
        parent::beforeSave($insert);
        if ($this->tariff_id) {
            $modelUser = UserExtend::findOne($this->user_id);
            $modelTariff = AdsTariffExtend::findOne($this->tariff_id);
            if ($modelUser->balance < $modelTariff->price) {
                $this->addError($this->tariff_id, 'Недостаточно средств.');
                \Yii::$app->session->set(
                    'message',
                    [
                        'type'      => 'danger',
                        'icon'      => 'glyphicon glyphicon-bell',
                        'message'   => ' '.\Yii::t('app', 'Недостаточно средств.'),
                    ]
                );
                return false;
            }
            $modelUser->balance = $modelUser->balance - $modelTariff->price;
            $modelUser->save();

            $this->tariff_id = null;
            $this->is_paid = 1;
            if ($this->end_paid > time()) {
                $this->end_paid = $this->end_paid - time();
            } else {
                $this->end_paid = 0;
            }
            $this->end_paid = $this->end_paid + strtotime('+'.$modelTariff->period.' day', time());;
        }
        if ($this->user_id == null) {
            $this->user_id = \Yii::$app->user->id;
        }
        $this->image_main = 'mainAds';
        $this->images = 'imagesAds';
        if ($this->city) {
            $this->city_id = $this->city;
        }
        //dd($this);
        return true;
    }
}
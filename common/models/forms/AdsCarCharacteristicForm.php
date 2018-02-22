<?php
/**
 * Created by PhpStorm.
 * User: Raketos - http://raketos.ru
 * Date: 27.03.2017
 * Time: 11:40
 */

namespace common\models\forms;


use common\models\extend\AdsCarCharacteristicExtend;
use common\models\extend\CarCharacteristicValueExtend;

class AdsCarCharacteristicForm extends AdsCarCharacteristicExtend
{
    public $id_car_modification;

    public function rules()
    {
        $items = AdsCarCharacteristicExtend::rules();
        $items[] = ['id_car_modification', 'integer'];
        return $items;
    }

    public function beforeSave($insert)
    {
        parent::beforeSave($insert);
        $characteristicValues = $this->getCharacteristicValueList();
        /*dd($this);
        dd($characteristicValues);*/
        foreach ($characteristicValues as $characteristicValue) {
            /* @var $characteristicValue \common\models\CarCharacteristicValue */
            $name = $characteristicValue->characteristic->name;
            $value = $characteristicValue->value;
            $unit = $characteristicValue->unit;
            switch ($name) {
                case 'Количество мест':
                    $this->number_of_seats = $value;
                    break;
                case 'Длина':
                    $this->length = $value;
                    break;
                case 'Ширина':
                    $this->width = $value;
                    break;
                case 'Высота':
                    $this->height = $value;
                    break;
                case 'Колёсная база':
                    $this->wheelbase = $value;
                    break;
                case 'Колея передняя':
                    $this->track_front = $value;
                    break;
                case 'Колея задняя':
                    $this->rear_track = $value;
                    break;
                case 'Дорожный просвет':
                    $this->ground_clearance = $value;
                    break;
                case 'Объем багажника максимальный':
                    $this->trunk_volume_max = $value;
                    break;
                case 'Объем багажника минимальный':
                    $this->trunk_volume_min = $value;
                    break;
                case 'Тип двигателя':
                    $this->engine_type = $value;
                    break;
                case 'Объем двигателя':
                    $this->engine_capacity = $value;
                    break;
                case 'Мощность двигателя':
                    $this->engine_power = $value;
                    break;
                case 'Обороты максимальной мощности':
                    $this->turnover_of_max_power = $value;
                    break;
                case 'Тип впуска':
                    $this->inlet_type = $value;
                    break;
                case 'Расположение цилиндров':
                    $this->cylinder_arrangement = $value;
                    break;
                case 'Количество цилиндров':
                    $this->number_of_cylinders = $value;
                    break;
                case 'Диаметр цилиндра':
                    $this->cylinder_diameter = $value;
                    break;
                case 'Ход поршня':
                    $this->piston_stroke = $value;
                    break;
                case 'Количество клапанов на цилиндр':
                    $this->number_of_valves_per_cylinder = $value;
                    break;
                case 'Марка топлива':
                    $this->fuel_grade = $value;
                    break;
                case 'Передняя подвеска':
                    $this->front_suspension = $value;
                    break;
                case 'Задняя подвеска':
                    $this->rear_suspension = $value;
                    break;
                case 'Тип КПП':
                    $this->gearbox_type = $value;
                    break;
                case 'Количество передач':
                    $this->number_of_gears = $value;
                    break;
                case 'Привод':
                    $this->drive_unit = $value;
                    break;
                case 'Передние тормоза':
                    $this->front_brakes = $value;
                    break;
                case 'Задние тормоза':
                    $this->rear_brakes = $value;
                    break;
                case 'Максимальная скорость':
                    $this->max_speed = $value;
                    break;
                case 'Разгон до 100 км/ч':
                    $this->acceleration_to_100 = $value;
                    break;
                case 'Расход топлива в городе на 100 км':
                    $this->fuel_consumption_city_for_100 = $value;
                    break;
                case 'Расход топлива на шоссе на 100 км':
                    $this->fuel_consumption_highway_for_100 = $value;
                    break;
                case 'Расход топлива в смешанном цикле на 100 км':
                    $this->fuel_consumption_mixed_cycle_for_100 = $value;
                    break;
                case 'Снаряженная масса':
                    $this->curb_weight = $value;
                    break;
                case 'Объём топливного бака':
                    $this->fuel_tank_capacity = $value;
                    break;
                case 'Максимальный крутящий момент':
                    $this->max_torque = $value;
                    break;
                case 'Запас хода':
                    $this->power_reserve = $value;
                    break;
                case 'Обороты максимального крутящего момента':
                    $this->max_torque_revolutions = $value;
                    break;
                case 'Экологический стандарт':
                    $this->eco_standard = $value;
                    break;
            }
        }
        return true;
    }

    public function getCharacteristicValueList()
    {
        $models = CarCharacteristicValueExtend::find()->where(['id_car_modification' => $this->id_car_modification])->all();
        return $models;
    }
}
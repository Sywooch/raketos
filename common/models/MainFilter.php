<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "main_filter".
 *
 * @property integer $id
 * @property string $name
 * @property string $body
 * @property integer $number_of_seats
 * @property integer $width
 * @property integer $length
 * @property integer $height
 * @property integer $wheelbase
 * @property integer $track_front
 * @property integer $trunk_volume_min
 * @property integer $trunk_volume_max
 * @property integer $rear_track
 * @property integer $ground_clearance
 * @property string $engine_type
 * @property integer $engine_capacity
 * @property integer $engine_power
 * @property string $turnover_of_max_power
 * @property integer $max_torque
 * @property string $inlet_type
 * @property string $cylinder_arrangement
 * @property integer $number_of_cylinders
 * @property integer $cylinder_diameter
 * @property integer $piston_stroke
 * @property integer $number_of_valves_per_cylinder
 * @property string $fuel_grade
 * @property string $front_suspension
 * @property string $rear_suspension
 * @property string $gearbox_type
 * @property integer $number_of_gears
 * @property string $drive_unit
 * @property string $front_brakes
 * @property integer $rear_brakes
 * @property integer $max_speed
 * @property string $acceleration_to_100
 * @property string $fuel_consumption_city_for_100
 * @property string $fuel_consumption_highway_for_100
 * @property string $fuel_consumption_mixed_cycle_for_100
 * @property integer $curb_weight
 * @property integer $full_mass
 * @property integer $fuel_tank_capacity
 * @property integer $power_reserve
 * @property integer $eco_standard
 * @property integer $max_torque_revolutions
 */
class MainFilter extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'main_filter';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['number_of_seats', 'width', 'length', 'height', 'wheelbase', 'track_front', 'trunk_volume_min', 'trunk_volume_max', 'rear_track', 'ground_clearance', 'engine_capacity', 'engine_power', 'max_torque', 'number_of_cylinders', 'cylinder_diameter', 'piston_stroke', 'number_of_valves_per_cylinder', 'number_of_gears', 'rear_brakes', 'max_speed', 'curb_weight', 'full_mass', 'fuel_tank_capacity', 'power_reserve', 'eco_standard', 'max_torque_revolutions'], 'integer'],
            [['acceleration_to_100', 'fuel_consumption_city_for_100', 'fuel_consumption_highway_for_100', 'fuel_consumption_mixed_cycle_for_100'], 'number'],
            [['name'], 'string', 'max' => 10],
            [['body', 'front_suspension', 'rear_suspension'], 'string', 'max' => 255],
            [['engine_type'], 'string', 'max' => 40],
            [['turnover_of_max_power', 'fuel_grade', 'gearbox_type', 'drive_unit'], 'string', 'max' => 20],
            [['inlet_type', 'cylinder_arrangement', 'front_brakes'], 'string', 'max' => 30],
            [['name'], 'unique'],
            [['body'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Метка',
            'body' => 'Кузов',
            'number_of_seats' => 'Количество мест',
            'width' => 'Ширина (мм)',
            'length' => 'Длина (мм)',
            'height' => 'Высота (мм)',
            'wheelbase' => 'Колёсная база (мм)',
            'track_front' => 'Колея передняя (мм)',
            'trunk_volume_min' => 'Объем багажника минимальный (л)',
            'trunk_volume_max' => 'Объем багажника максимальный (л)',
            'rear_track' => 'Колея задняя (мм)',
            'ground_clearance' => 'Дорожный просвет (мм)',
            'engine_type' => 'Тип двигателя',
            'engine_capacity' => 'Объем двигателя (см3)',
            'engine_power' => 'Мощность двигателя (л.с.)',
            'turnover_of_max_power' => 'Обороты максимальной мощности (об/мин)',
            'max_torque' => 'Максимальный крутящий момент (Н*м)',
            'inlet_type' => 'Тип впуска',
            'cylinder_arrangement' => 'Расположение цилиндров',
            'number_of_cylinders' => 'Количество цилиндров',
            'cylinder_diameter' => 'Диаметр цилиндра (мм)',
            'piston_stroke' => 'Ход поршня (мм)',
            'number_of_valves_per_cylinder' => 'Количество клапанов на цилиндр',
            'fuel_grade' => 'Марка топлива',
            'front_suspension' => 'Передняя подвеска',
            'rear_suspension' => 'Задняя подвеска',
            'gearbox_type' => 'Тип КПП',
            'number_of_gears' => 'Количество передач',
            'drive_unit' => 'Привод',
            'front_brakes' => 'Передние тормоза',
            'rear_brakes' => 'Задние тормоза',
            'max_speed' => 'Максимальная скорость (км/ч)',
            'acceleration_to_100' => 'Разгон до 100 км/ч (сек)',
            'fuel_consumption_city_for_100' => 'Расход топлива в городе на 100 км (л)',
            'fuel_consumption_highway_for_100' => 'Расход топлива на шоссе на 100 км (л)',
            'fuel_consumption_mixed_cycle_for_100' => 'Расход топлива в смешанном цикле на 100 км (л)',
            'curb_weight' => 'Снаряженная масса (кг)',
            'full_mass' => 'Полная масса (кг)',
            'fuel_tank_capacity' => 'Объём топливного бака (л)',
            'power_reserve' => 'Запас хода (км)',
            'eco_standard' => 'Экологический стандарт',
            'max_torque_revolutions' => 'Обороты максимального крутящего момента (об/мин)',
        ];
    }
}

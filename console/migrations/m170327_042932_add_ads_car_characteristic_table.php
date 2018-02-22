<?php

use yii\db\Migration;

class m170327_042932_add_ads_car_characteristic_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%ads_car_characteristic}}', [
            'id'                    => $this->primaryKey()->comment('ID'),
            'number_of_seats'       => $this->integer(2)->comment('Количество мест'),
            'width'                 => $this->integer(5)->comment('Ширина (мм)'),
            'length'                => $this->integer(5)->comment('Длина (мм)'),
            'height'                => $this->integer(5)->comment('Высота (мм)'),
            'wheelbase'             => $this->integer(5)->comment('Колёсная база (мм)'),
            'track_front'           => $this->integer(5)->comment('Колея передняя (мм)'),
            'trunk_volume_min'      => $this->integer(4)->comment('Объем багажника минимальный (л)'),
            'trunk_volume_max'      => $this->integer(4)->comment('Объем багажника максимальный (л)'),
            'rear_track'            => $this->integer(5)->comment('Колея задняя (мм)'),
            'ground_clearance'      => $this->integer(5)->comment('Дорожный просвет (мм)'),
            'engine_type'           => $this->string(40)->comment('Тип двигателя'),
            'engine_capacity'       => $this->integer(5)->comment('Объем двигателя (см3)'),
            'engine_power'          => $this->integer(4)->comment('Мощность двигателя (л.с.)'),
            'turnover_of_max_power' => $this->string(20)->comment('Обороты максимальной мощности (об/мин)'),
            'max_torque'            => $this->integer(4)->comment('Максимальный крутящий момент (Н*м)'),
            'inlet_type'            => $this->string(30)->comment('Тип впуска'),                     // 0 - распределенный впрыск
            'cylinder_arrangement'  => $this->string(30)->comment('Расположение цилиндров'),         // 0 - рядный
            'number_of_cylinders'   => $this->integer(2)->comment('Количество цилиндров'),
            'cylinder_diameter'     => $this->integer(3)->comment('Диаметр цилиндра (мм)'),
            'piston_stroke'         => $this->integer(3)->comment('Ход поршня (мм)'),
            'number_of_valves_per_cylinder'   => $this->integer(2)->comment('Количество клапанов на цилиндр'),
            'fuel_grade'            => $this->string(20)->comment('Марка топлива'),                  // 0 - АИ-95
            'front_suspension'      => $this->string()->comment('Передняя подвеска'),
            'rear_suspension'       => $this->string()->comment('Задняя подвеска'),
            'gearbox_type'          => $this->string(20)->comment('Тип КПП'),                        // 0 - Механика
            'number_of_gears'       => $this->integer(1)->comment('Количество передач'),
            'drive_unit'            => $this->string(20)->comment('Привод'),                         // 0 - Передний
            'front_brakes'          => $this->string(30)->comment('Передние тормоза'),               // 0 - Дисковые вентилируемые
            'rear_brakes'           => $this->integer(1)->comment('Задние тормоза'),                 // 1 - Барабанные
            'max_speed'             => $this->integer(4)->comment('Максимальная скорость (км/ч)'),
            'acceleration_to_100'   => $this->decimal(3,1)->comment('Разгон до 100 км/ч (сек)'),
            'fuel_consumption_city_for_100' => $this->decimal(3,1)->comment('Расход топлива в городе на 100 км (л)'),
            'fuel_consumption_highway_for_100' => $this->decimal(3,1)->comment('Расход топлива на шоссе на 100 км (л)'),
            'fuel_consumption_mixed_cycle_for_100' => $this->decimal(3,1)->comment('Расход топлива в смешанном цикле на 100 км (л)'),
            'curb_weight'           => $this->integer(5)->comment('Снаряженная масса (кг)'),
            'full_mass'             => $this->integer(5)->comment('Полная масса (кг)'),
            'fuel_tank_capacity'    => $this->integer(4)->comment('Объём топливного бака (л)'),
            'power_reserve'         => $this->integer(4)->comment('Запас хода (км)'),
            'eco_standard'          => $this->integer(1)->comment('Экологический стандарт'),        // 0 - нет, 1 - EURO V
            'max_torque_revolutions' => $this->integer(5)->comment('Обороты максимального крутящего момента (об/мин)'),
            'ads_id'                => $this->integer()->notNull()->comment('Объявление'),
        ], $tableOptions);

        $this->addForeignKey('ads_car_characteristic_fk', '{{%ads_car_characteristic}}', 'ads_id', '{{%ads}}', 'id', 'CASCADE', 'CASCADE');

        $this->db->createCommand("COPY {{%ads_car_characteristic}} FROM '/var/www/setyes/data/www/car.raketos.ru/console/migrations/csv/ads_car_characteristic.csv'
            WITH (
            FORMAT CSV,
            DELIMITER ';',
            HEADER true
            )")->execute();
    }

    public function down()
    {
        $this->dropForeignKey('ads_car_characteristic_fk', '{{%ads_car_characteristic}}');
        $this->dropTable('{{%ads_car_characteristic}}');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}

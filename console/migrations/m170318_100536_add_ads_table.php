<?php

use yii\db\Migration;

class m170318_100536_add_ads_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%ads}}', [
            'id'                    => $this->primaryKey()->comment('ID'),
            'id_car_mark'           => $this->integer()->comment('Марка'),
            'id_car_model'          => $this->integer()->comment('Модель'),
            'id_car_generation'     => $this->integer()->comment('Поколение'),
            'id_car_serie'          => $this->integer()->comment('Серия'),
            'id_car_modification'   => $this->integer()->comment('Модификация'),
            'mileage'               => $this->integer()->notNull()->comment('Пробег, км'),
            'power_ptc'             => $this->integer()->comment('Мощность по ПТС'),
            'mileage_rus'           => $this->boolean()->defaultValue(true)->comment('С пробегом в России'),
            'doc'                   => $this->boolean()->defaultValue(true)->comment('С документами'),
            'broken'                => $this->boolean()->defaultValue(false)->comment('Битый'),
            'work'                  => $this->boolean()->defaultValue(true)->comment('На ходу'),
            'vin'                   => $this->string()->comment('VIN (номер кузова)'),
            'num_reg'               => $this->string()->comment('Номер свидетельства о регистрации'),
            'desc'                  => $this->text()->comment('Описание'),
            'price'                 => $this->integer()->comment('Цена'),
            'exchange'              => $this->boolean()->defaultValue(false)->comment('Возможен обмен'),
            'user_id'               => $this->integer()->comment('Пользователь'),
            'city_id'               => $this->integer()->comment('Город'),
            'address'               => $this->string()->comment('Адрес или ориентир'),
            'image_main'            => $this->string(20)->defaultValue('mainAds')->comment('Метка изображения'),
            'images'                => $this->string(20)->defaultValue('imagesAds')->comment('Метка изображения доп фото'),
            'temp'                  => $this->boolean()->defaultValue(true)->comment('Временное'),
            'status'                => $this->smallInteger(1)->defaultValue(1)->comment('Статус'),
            'year'                  => $this->integer()->notNull()->comment('Год выпуска'),
            'color'                 => $this->string(50)->comment('Цвет'),
            'state'                 => $this->integer(1)->comment('Состояние'),  // 1 - отличное, 2 - хорошее, 3 - среднее, 4 - аварийное, 5 - на запчасти
            'rating'                => $this->integer()->defaultValue(0)->comment('Рейтинг'),
            'is_paid'               => $this->boolean()->defaultValue(false)->comment('Платное объявление'),
            'end_paid'              => $this->integer()->comment('Дата окончания оплаты'),
            'tariff_id'             => $this->integer()->comment('Тариф'),
            'created_at'            => $this->integer()->comment('Дата создания'),
            'updated_at'            => $this->integer()->comment('Дата изменения')
        ], $tableOptions);

        $this->addForeignKey('ads_model_fk', '{{%ads}}', 'id_car_model', '{{%car_model}}', 'id_car_model');
        $this->addForeignKey('ads_generation_fk', '{{%ads}}', 'id_car_generation', '{{%car_generation}}', 'id_car_generation');
        $this->addForeignKey('ads_serie_fk', '{{%ads}}', 'id_car_serie', '{{%car_serie}}', 'id_car_serie');
        $this->addForeignKey('ads_modification_fk', '{{%ads}}', 'id_car_modification', '{{%car_modification}}', 'id_car_modification');
        $this->addForeignKey('ads_user_fk', '{{%ads}}', 'user_id', '{{%user}}', 'id');

        $this->db->createCommand("COPY ads FROM '/var/www/setyes/data/www/car.raketos.ru/console/migrations/csv/ads.csv'
            WITH (
            FORMAT CSV,
            DELIMITER ';',
            HEADER true
            )")->execute();
    }

    public function down()
    {
        $this->dropTable('ads');
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

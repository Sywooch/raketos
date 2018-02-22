<?php

use yii\db\Migration;

class m170413_105100_add_rating_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%rating_calculate}}', [
            'id_rating_calculate'   => $this->primaryKey()->comment('ID'),
            'mileage'               => $this->string(1)->defaultValue('П')->comment('Пробег'),
            'year'                  => $this->string(1)->defaultValue('Г')->comment('Год'),
            'state'                 => $this->string(1)->defaultValue('С')->comment('Состояние'),
            'rating'                => $this->string(1)->defaultValue('Р')->comment('Рейтинг'),
            'price'                 => $this->string(1)->defaultValue('Ц')->comment('Цепа'),
            'formula'               => $this->string()->notNull()->comment('Формула'),
        ], $tableOptions);

        $this->db->createCommand("COPY {{%rating_calculate}} FROM '/var/www/setyes/data/www/car.raketos.ru/console/migrations/csv/rating_calculate.csv'
            WITH (
            FORMAT CSV,
            DELIMITER ';',
            HEADER true
            )")->execute();
    }

    public function down()
    {
        $this->dropTable('{{%rating_calculate}}');
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

<?php

use yii\db\Migration;

class m170404_034142_add_tariff_table extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%ads_tariff}}', [
            'id'                    => $this->primaryKey()->comment('ID'),
            'name'                  => $this->string()->notNull()->comment('Название'),
            'period'                => $this->integer()->notNull()->comment('Период (кол-во дней)'),
            'price'                 => $this->integer()->notNull()->comment('Стоимость'),
        ], $tableOptions);

        $this->addForeignKey('ads_tariff_fk', '{{%ads}}', 'tariff_id', '{{%ads_tariff}}', 'id');

        $this->db->createCommand("COPY ads_tariff FROM '/var/www/setyes/data/www/car.raketos.ru/console/migrations/csv/ads_tariff.csv'
            WITH (
            FORMAT CSV,
            DELIMITER ';',
            HEADER true
            )")->execute();
    }

    public function down()
    {
        $this->dropForeignKey('ads_tariff_fk', '{{%ads}}');
        $this->dropTable('{{%ads_tariff}}');

        /*$this->dropColumn('{{%ads_car_characteristic}}', 'is_paid');
        $this->dropColumn('{{%ads_car_characteristic}}', 'end_paid');
        $this->dropColumn('{{%ads_car_characteristic}}', 'tariff_id');*/
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

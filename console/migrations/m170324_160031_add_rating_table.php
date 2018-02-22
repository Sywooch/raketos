<?php

use yii\db\Migration;

class m170324_160031_add_rating_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%rating}}', [
            'id'                    => $this->primaryKey()->comment('ID'),
            'ads_id'                => $this->integer()->notNull()->comment('Объявление'),
            'user_id'               => $this->integer()->notNull()->comment('Пользователь'),
        ], $tableOptions);

        $this->addForeignKey('rating_user_fk', '{{%rating}}', 'user_id', '{{%user}}', 'id');
        $this->addForeignKey('rating_ads_fk', '{{%rating}}', 'ads_id', '{{%ads}}', 'id');

        $this->db->createCommand("COPY {{%rating}} FROM '/var/www/setyes/data/www/car.raketos.ru/console/migrations/csv/rating.csv'
            WITH (
            FORMAT CSV,
            DELIMITER ';',
            HEADER true
            )")->execute();
    }

    public function down()
    {
        $this->dropForeignKey('rating_ads_fk', '{{%rating}}');
        $this->dropForeignKey('rating_user_fk', '{{%rating}}');
        $this->dropTable('{{%rating}}');
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

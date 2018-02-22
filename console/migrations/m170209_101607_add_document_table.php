<?php

use yii\db\Migration;

class m170209_101607_add_document_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%document}}', [
            'id'        => $this->primaryKey()->comment('ID'),
            'name'      => $this->string()->notNull()->comment('Название'),
            'meta_keys' => $this->string()->comment('Мета ключи'),
            'meta_desc' => $this->string()->comment('Мета описание'),
            'text'      => $this->text()->notNull()->comment('Контент'),
            'type'      => $this->string()->notNull()->comment('Тип документа'),
            'created_at' => $this->integer()->comment('Дата создания'),
            'updated_at' => $this->integer()->comment('Дата изменения')
        ], $tableOptions);

        $this->db->createCommand("COPY {{%document}} FROM '/var/www/setyes/data/www/car.raketos.ru/console/migrations/csv/document.csv'
            WITH (
            FORMAT CSV,
            DELIMITER ';',
            HEADER true
            )")->execute();
    }

    public function down()
    {
        $this->dropTable('{{%document}}');
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

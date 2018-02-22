<?php

use yii\db\Migration;

/**
 * Handles the creation of table `info`.
 */
class m170209_163613_create_info_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%info}}', [
            'id'            => $this->primaryKey()->comment('ID'),
            'name'          => $this->string()->notNull()->comment('Название'),
            'short_desc'    => $this->text()->notNull()->comment('Короткое описание'),
            'meta_keys'     => $this->string()->comment('Мета ключи'),
            'meta_desc'     => $this->string()->comment('Мета описание'),
            'text'          => $this->text()->notNull()->comment('Контент'),
            'user_id'       => $this->integer()->comment('Пользователь'),
            'created_at'    => $this->integer()->comment('Дата создания'),
            'updated_at'    => $this->integer()->comment('Дата изменения')
        ]);

        $this->addForeignKey('info_user_fk', '{{%info}}', 'user_id', '{{%user}}', 'id');

        /*$this->db->createCommand("COPY {{%info}} FROM '/var/www/setyes/data/www/car.raketos.ru/console/migrations/csv/info.csv'
            WITH (
            FORMAT CSV,
            DELIMITER ';',
            HEADER true
            )")->execute();*/
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('info_user_fk', '{{%info}}');
        $this->dropTable('info');
    }
}

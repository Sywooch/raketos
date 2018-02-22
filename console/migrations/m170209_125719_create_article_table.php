<?php

use yii\db\Migration;

/**
 * Handles the creation of table `article`.
 */
class m170209_125719_create_article_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%article}}', [
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

        $this->addForeignKey('article_user_fk', '{{%article}}', 'user_id', '{{%user}}', 'id');

        $this->db->createCommand("COPY {{%article}} FROM '/var/www/setyes/data/www/car.raketos.ru/console/migrations/csv/article.csv'
            WITH (
            FORMAT CSV,
            DELIMITER ';',
            HEADER true
            )")->execute();
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('article_user_fk', '{{%article}}');
        $this->dropTable('article');
    }
}

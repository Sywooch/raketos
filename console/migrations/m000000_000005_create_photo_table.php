<?php
use yii\db\Migration;

class m000000_000005_create_photo_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('photo',
            [
                'id'            => $this->primaryKey(),
                'file'          => $this->string(255)->notNull(),
                'file_small'    => $this->string(255)->notNull(),
                'type'          => $this->string(32)->notNull(),
                'object_id'     => $this->integer(),
                'user_id'       => $this->integer(),
                'deleted'       => $this->boolean()->notNull()->defaultValue(false),
                'created_at'    => $this->integer(),
                'updated_at'    => $this->integer(),
            ]
        );

        $this->addForeignKey('photo_user_fk', '{{%photo}}', 'user_id', '{{%user}}', 'id', 'CASCADE');

        $this->db->createCommand("COPY {{%photo}} FROM '/var/www/setyes/data/www/car.raketos.ru/console/migrations/csv/photo.csv'
            WITH (
            FORMAT CSV,
            DELIMITER ';',
            HEADER true
            )")->execute();
    }

    public function down()
    {
        $this->dropTable('photo');
    }
}

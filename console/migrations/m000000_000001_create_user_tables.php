<?php

use yii\db\Migration;

/**
 * Handles the creation for table `user`.
 */
class m000000_000001_create_user_tables extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id'                    => $this->primaryKey()->comment('ID'),
            'username'              => $this->string()->unique()->comment(Yii::t('app', 'Логин')),
            'phone'                 => $this->string(20)->unique()->comment(Yii::t('app', 'Телефон')),
            'email'                 => $this->string()->unique()->comment(Yii::t('app', 'Электронная почта')),
            'first_name'            => $this->string()->comment(Yii::t('app', 'Имя')),
            'last_name'             => $this->string()->comment(Yii::t('app', 'Фамилия')),
            'middle_name'           => $this->string()->comment(Yii::t('app', 'Отчество')),
            'balance'               => $this->integer()->defaultValue(0)->comment(Yii::t('app', 'Баланс')),
            'image_main'            => $this->string(20)->defaultValue('mainUser')->comment(Yii::t('app', 'Метка изображения')),
            'images'                => $this->string(20)->defaultValue('imagesUser')->comment(Yii::t('app', 'Метка изображения доп фото')),
            'directory'             => $this->string(10)->comment(Yii::t('app', 'Папка пользователя')),
            'status'                => $this->smallInteger(1)->comment(Yii::t('app', 'Статус')),
            'password_hash'         => $this->string()->comment(Yii::t('app', 'Пароль')),
            'password_encrypted'    => $this->string()->comment(Yii::t('app', 'Зашифрованный пароль')),
            'auth_key'              => $this->string(32)->comment(Yii::t('app', 'Ключ авторизации')),
            'password_reset_token'  => $this->string()->comment(Yii::t('app', 'Ключ сброса пароля')),
            'email_confirm_token'   => $this->string()->comment(Yii::t('app', 'Ключ подтверждения эл. адреса')),
            'created_at'            => $this->integer()->comment('Дата создания'),
            'updated_at'            => $this->integer()->comment('Дата изменения')
        ], $tableOptions);

        $this->db->createCommand("COPY {{%user}} FROM '/var/www/setyes/data/www/car.raketos.ru/console/migrations/csv/user.csv'
            WITH (
            FORMAT CSV,
            DELIMITER ';',
            HEADER true
            )")->execute();

        /* Пользователи онлайн */
        $this->createTable('{{%user_online}}', [
            'user_id'           => $this->primaryKey(),
            'online'            => $this->integer()
        ], $tableOptions);

        $this->addForeignKey('online_user_fk', '{{%user_online}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('user');
    }
}

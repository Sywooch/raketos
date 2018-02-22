<?php

use yii\db\Migration;

class m170512_043352_add_invoice_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%invoice}}', [
            'id'                    => $this->primaryKey()->comment('ID'),
            'sum'                   => $this->integer()->comment('Стоимость'),
            'id_ads'                => $this->integer()->comment('Объявление'),
            'id_tariff'             => $this->integer()->comment('Тариф'),
            'id_user'               => $this->integer()->comment('Пользователь'),
            'status'                => $this->integer()->defaultValue(0)->comment('Статус'),    // 0 - ожидание, 1 - оплачен, 2 - не оплачен
            'created_at'            => $this->integer()->comment('Дата создания'),
            'updated_at'            => $this->integer()->comment('Дата изменения')
        ], $tableOptions);

        $this->addForeignKey('invoice_ads_fk', '{{%invoice}}', 'id_ads', '{{%ads}}', 'id');
        $this->addForeignKey('invoice_tariff_fk', '{{%invoice}}', 'id_tariff', '{{%ads_tariff}}', 'id');
        $this->addForeignKey('invoice_user_fk', '{{%invoice}}', 'id_user', '{{%user}}', 'id');
    }

    public function down()
    {
        $this->dropForeignKey('invoice_ads_fk', '{{%invoice}}');
        $this->dropForeignKey('invoice_tariff_fk', '{{%invoice}}');
        $this->dropForeignKey('invoice_user_fk', '{{%invoice}}');

        $this->dropTable('{{%invoice}}');
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

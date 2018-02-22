<?php

use yii\db\Migration;

/**
 * Handles the creation of table `question`.
 */
class m170210_072335_create_question_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('question', [
            'id'            => $this->primaryKey()->comment('ID'),
            'question'      => $this->text()->comment('Вопрос'),
            'answer'        => $this->text()->comment('Ответ'),
            'status'        => $this->smallInteger(1)->defaultValue(0)->comment(Yii::t('app', 'Статус')),    // 0 - не отвечено, 1 - отвечено, 2 - заблокировано
            'user_id'       => $this->integer()->comment('Пользователь'),
            'created_at'    => $this->integer()->comment('Дата создания'),
            'updated_at'    => $this->integer()->comment('Дата изменения')
        ]);

        $this->addForeignKey('question_user_fk', '{{%question}}', 'user_id', '{{%user}}', 'id');

        $this->db->createCommand("COPY {{%question}} FROM '/var/www/setyes/data/www/car.raketos.ru/console/migrations/csv/question.csv'
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
        $this->dropForeignKey('question_user_fk', '{{%question}}');
        $this->dropTable('question');
    }
}

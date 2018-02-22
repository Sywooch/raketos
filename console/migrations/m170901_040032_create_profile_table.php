<?php

use yii\db\Migration;

/**
 * Handles the creation of table `profile`.
 * Has foreign keys to the tables:
 *
 * - `user`
 */
class m170901_040032_create_profile_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('profiles', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'name' => $this->string(),
            'phone' => $this->string(),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-profile-user_id',
            'profiles',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-profile-user_id',
            'profiles',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-profile-user_id',
            'profiles'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-profile-user_id',
            'profiles'
        );

        $this->dropTable('profiles');
    }
}

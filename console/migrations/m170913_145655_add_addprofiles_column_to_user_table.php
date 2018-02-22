<?php

use yii\db\Migration;

/**
 * Handles adding addprofiles to table `user`.
 */
class m170913_145655_add_addprofiles_column_to_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('user', 'addprofiles', $this->integer());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('user', 'addprofiles');
    }
}

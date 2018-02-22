<?php

use yii\db\Migration;

/**
 * Handles adding profile_id to table `ads`.
 */
class m170901_040748_add_profile_id_column_to_ads_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('ads', 'profile_id', $this->integer());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('ads', 'profile_id');
    }
}

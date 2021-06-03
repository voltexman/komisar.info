<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%statistics}}`.
 */
class m210602_190622_add_real_guest_column_to_statistics_table extends Migration
{
    public function up()
    {
        $this->addColumn('{{%statistics}}', 'real_guest', $this->smallInteger());
    }

    public function down()
    {
        $this->dropColumn('{{%statistics}}', 'real_guest');
    }
}

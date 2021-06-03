<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%statistics}}`.
 */
class m210603_102051_add_status_column_to_statistics_table extends Migration
{
    public function up()
    {
        $this->addColumn('{{%statistics}}', 'status', $this->smallInteger()->after('os'));
    }

    public function down()
    {
        $this->dropColumn('{{%statistics}}', 'status');
    }
}

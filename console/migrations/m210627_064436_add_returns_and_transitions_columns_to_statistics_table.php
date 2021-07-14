<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%statistics}}`.
 */
class m210627_064436_add_returns_and_transitions_columns_to_statistics_table extends Migration
{
    public function up()
    {
        $this->addColumn('{{%statistics}}', 'returns', $this->integer()->after('accuracy'));
        $this->addColumn('{{%statistics}}', 'transitions', $this->integer()->after('returns'));
    }

    public function down()
    {
        $this->dropColumn('{{%statistics}}', 'returns');
        $this->dropColumn('{{%statistics}}', 'transitions');
    }
}

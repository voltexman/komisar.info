<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%sentences}}`.
 */
class m210627_095909_add_status_columns_to_sentences_table extends Migration
{
    public function up()
    {
        $this->addColumn('{{%sentences}}', 'status', $this->smallInteger());
    }

    public function down()
    {
        $this->dropColumn('{{%sentences}}', 'status');
    }
}

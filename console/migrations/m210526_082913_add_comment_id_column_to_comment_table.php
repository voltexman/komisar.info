<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%comment}}`.
 */
class m210526_082913_add_comment_id_column_to_comment_table extends Migration
{
    public function up()
    {
        $this->addColumn('{{%comments}}', 'comment_id', $this->integer());
    }

    public function down()
    {
        $this->dropColumn('{{%comments}}', 'comment_id');
    }
}

<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%comment}}`.
 */
class m210526_083745_add_reply_column_to_comment_table extends Migration
{
    public function up()
    {
        $this->addColumn('{{%comments}}', 'reply', $this->smallInteger());
    }

    public function down()
    {
        $this->dropColumn('{{%comments}}', 'reply');
    }
}

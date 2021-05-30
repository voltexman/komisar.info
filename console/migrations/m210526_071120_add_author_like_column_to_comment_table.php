<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%comment}}`.
 */
class m210526_071120_add_author_like_column_to_comment_table extends Migration
{
    public function up()
    {
        $this->addColumn('{{%comments}}', 'author_like', $this->boolean());
    }

    public function down()
    {
        $this->dropColumn('{{%comments}}', 'author_like');
    }
}

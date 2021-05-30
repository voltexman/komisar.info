<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%articles}}`.
 */
class m210517_052023_add_column_to_articles_table extends Migration
{
    public function up()
    {
        $this->addColumn('{{%articles}}', 'tags', $this->text());
    }

    public function down()
    {
        $this->dropColumn('{{%articles}}', 'tags');
    }
}

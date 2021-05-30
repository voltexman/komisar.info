<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%visited_page}}`.
 */
class m210528_114111_create_visited_page_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%visited_page}}', [
            'id' => $this->primaryKey(),
            'statistics_id' => $this->integer(),
            'page' => $this->string(),
            'link' => $this->string(),
            'visited_at' => $this->dateTime(),
            'viewing_time' => $this->integer()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%visited_page}}');
    }
}

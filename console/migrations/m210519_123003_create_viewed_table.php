<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%viewed}}`.
 */
class m210519_123003_create_viewed_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%viewed}}', [
            'id' => $this->primaryKey(),
            'ip_address' => $this->string(),
            'article_id' => $this->integer()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%viewed}}');
    }
}

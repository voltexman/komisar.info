<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%statistics}}`.
 */
class m210527_140552_create_statistics_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%statistics}}', [
            'id' => $this->primaryKey(),
            'ip' => $this->string(),
            'browser' => $this->string(),
            'device' => $this->string(),
            'os' => $this->string(),
            'city' => $this->string(),
            'type' => $this->string(),
            'visited_at' => $this->dateTime(),
            'latitude' => $this->string(),
            'longitude' => $this->string(),
            'accuracy' => $this->string()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%statistics}}');
    }
}

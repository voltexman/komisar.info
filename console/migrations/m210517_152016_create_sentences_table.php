<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%sentences}}`.
 */
class m210517_152016_create_sentences_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%sentences}}', [
            'id' => $this->primaryKey(),
            'theme' => $this->string(),
            'created_at' => $this->dateTime()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%sentences}}');
    }
}

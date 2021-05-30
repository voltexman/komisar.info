<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%articles}}`.
 */
class m201129_162353_create_articles_table extends Migration
{
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable('{{%articles}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'alias' => $this->string(255)->notNull(),
            'image' => $this->string(255),
            'short_text' => $this->text(),
            'text' => $this->text(),
            'created_at' => $this->dateTime(),
            'meta_title' => $this->string(255),
            'meta_keywords' => $this->string(255),
            'meta_description' => $this->string(255),
            'publication' => $this->boolean(),
            'indexation' => $this->boolean(),
            'viewed' => $this->integer()
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%articles}}');
    }
}

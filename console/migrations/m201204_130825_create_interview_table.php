<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%interview}}`.
 */
class m201204_130825_create_interview_table extends Migration
{
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable('{{%interviews}}', [
            'id' => $this->primaryKey(),
            'url' => $this->string(255),
            'name' => $this->string(255),
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
        $this->dropTable('{{%interviews}}');
    }
}

<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%contacts}}`.
 */
class m201207_171038_create_contacts_table extends Migration
{
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable('{{%contacts}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255),
            'email' => $this->string(255),
            'text' => $this->text(),
            'created_at' => $this->dateTime(),
            'status' => $this->boolean(),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%contacts}}');
    }
}

<?php

use yii\db\Migration;

/**
 * Class m210116_115350_add_interview_alias_field
 */
class m210116_115350_add_interview_alias_field extends Migration
{
    public function up()
    {
        $this->addColumn('{{%interviews}}', 'alias', $this->string(255)->notNull());
    }

    public function down()
    {
        $this->dropColumn('{{%interviews}}', 'alias');
    }
}

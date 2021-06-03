<?php

use yii\db\Migration;

/**
 * Class m210603_104347_remove_type_city_real_guest_column_from_statistics_table
 */
class m210603_104347_remove_type_city_real_guest_column_from_statistics_table extends Migration
{
    public function up()
    {
        $this->dropColumn('{{%statistics}}', 'type');
        $this->dropColumn('{{%statistics}}', 'city');
        $this->dropColumn('{{%statistics}}', 'real_guest');
    }

    public function down()
    {
        $this->addColumn('{{%statistics}}', 'type', $this->string());
        $this->addColumn('{{%statistics}}', 'city', $this->string());
        $this->addColumn('{{%statistics}}', 'real_guest', $this->integer());
    }
}

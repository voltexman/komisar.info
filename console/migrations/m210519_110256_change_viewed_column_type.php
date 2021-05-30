<?php

use yii\db\Migration;

/**
 * Class m210519_110256_change_viewed_column_type
 */
class m210519_110256_change_viewed_column_type extends Migration
{
    public function up()
    {
        $this->alterColumn('articles', 'viewed', $this->text());
    }

    public function down()
    {
        $this->alterColumn('articles', 'viewed', $this->integer());
    }
}

<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%comment}}`.
 */
class m210512_142951_create_comment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%comments}}', [
            'id' => $this->primaryKey(),
            'article_id' => $this->integer(),
            'name' => $this->string(),
            'text' => $this->text(),
            'created_at' => $this->dateTime(),
        ]);

        $this->createIndex(
            'idx-post-article_id',
            'comments',
            'article_id'
        );

        $this->addForeignKey(
            'fk-post-article_id',
            'comments',
            'article_id',
            'articles',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-post-article_id',
            'comments'
        );
        
        $this->dropIndex(
            'idx-post-article_id',
            'comments'
        );
        
        $this->dropTable('{{%comments}}');
    }
}

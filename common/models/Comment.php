<?php

namespace common\models;

use backend\models\Article;
use Yii;

/**
 * This is the model class for table "question".
 *
 * @property int $id
 * @property string $name
 * @property string $text
 * @property integer $created_at
 * @property integer $comment_id
 * @property integer $reply
 * @property int $article_id [int(11)]
 * @property bool $author_like [tinyint(1)]
 */
class Comment extends \yii\db\ActiveRecord
{
    const AUTHOR_LIKE = 1;
    const AUTHOR_UNLIKE = 0;

    const AUTHOR_REPLY = 2;
    const USER_REPLY = 1;
    const NO_REPLY = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'comments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['text'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['name', 'text'], 'required'],
            [['name', 'text'], 'trim'],
            [['author_like'], 'default', 'value' => self::AUTHOR_UNLIKE],
            [['reply'], 'default', 'value' => self::NO_REPLY],
            [['created_at'], 'default', 'value' => date('Y-m-d H:i:s')],
            [['comment_id'], 'exist', 'skipOnError' => true, 'targetClass' => Comment::class, 'targetAttribute' => ['comment_id' => 'id']],
            [['article_id'], 'exist', 'skipOnError' => true, 'targetClass' => Article::class, 'targetAttribute' => ['article_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'name' => 'Ім`я',
            'text' => 'Коментар',
            'created_at' => 'Создано'
        ];
    }

    /**
     * Gets query for [[Article]].
     */
    public function getArticle()
    {
        return $this->hasOne(Article::class, ['id' => 'article_id']);
    }

    /**
     * Gets query for [[Comments]].
     */
    public function getReplys()
    {
        return $this->hasMany(Comment::class, ['comment_id' => 'id']);
    }
}

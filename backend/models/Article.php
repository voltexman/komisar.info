<?php

namespace backend\models;

use common\models\Comment;
use yii\db\ActiveRecord;
use yii\helpers\Inflector;
use yii\helpers\Json;

/**
 * @property mixed|null name
 * @property mixed|string|null alias
 * @property int $id [int(11)]
 * @property string $image [varchar(255)]
 * @property string $text
 * @property string $created_at [datetime]
 * @property string $meta_title [varchar(255)]
 * @property string $meta_keywords [varchar(255)]
 * @property string $meta_description [varchar(255)]
 * @property int $viewed [int(11)]
 * @property string $short_text
 * @property bool $publication [tinyint(1)]
 * @property bool $indexation [tinyint(1)]
 * @property mixed|null tags
 */
class Article extends ActiveRecord
{
    const PUBLICATION_ON = 1;
    const PUBLICATION_OFF = 0;

    const INDEXATION_ON = 1;
    const INDEXATION_OFF = 0;

    public $publicationStatus = [
        self::PUBLICATION_ON => 'Опубликовано',
        self::PUBLICATION_OFF => 'Не опубликовано'
    ];

    public $indexationStatus = [
        self::INDEXATION_ON => 'Индексируется',
        self::INDEXATION_OFF => 'Не индексируется'
    ];

    public static function tableName(): string
    {
        return '{{%articles}}';
    }

    public function behaviors(): array
    {
        return [
            [
                'class' => '\yiidreamteam\upload\ImageUploadBehavior',
                'attribute' => 'image',
                'thumbs' => [
                    'admin_thumb' => ['width' => 400, 'height' => 300],
                    'blog_thumb' => ['width' => 720, 'height' => 480],
                    'blog_full' => ['width' => 1000, 'height' => 600],
                ],
                'filePath' => '@frontend/web/images/blog/[[pk]].[[extension]]',
                'fileUrl' => '/frontend/web/images/blog/[[pk]].[[extension]]',
                'thumbPath' => '@frontend/web/images/blog/[[profile]]_[[pk]].[[extension]]',
                'thumbUrl' => '/frontend/web/images/blog/[[profile]]_[[pk]].[[extension]]',
            ],
            'images' => [
                'class' => 'dvizh\gallery\behaviors\AttachImages',
                'mode' => 'gallery',
                'quality' => 60,
                'galleryId' => 'picture'
            ],
        ];
    }

    public function rules(): array
    {
        return [
            [['name', 'short_text'], 'required'],
            [['tags'], 'required', 'message' => 'Нужно указать минимум 1 тег'],
            [['name'], 'unique'],
            [['name', 'short_text', 'meta_title', 'meta_keywords', 'meta_description'], 'trim'],
            [['name'], 'string', 'min' => 50, 'max' => 255],
            [['short_text'], 'string', 'min' => '100', 'max' => 500],
            [['text', 'meta_title', 'meta_keywords', 'meta_description'], 'string'],
            [['image'], 'file', 'extensions' => 'jpg, jpeg, gif, png'],
            [['created_at'], 'default', 'value' => date('Y-m-d H:i:s')],
            [['publication', 'indexation'], 'boolean']
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'name' => 'Название статьи',
            'alias' => 'Псевдоним',
            'tags' => 'Теги',
            'text' => 'Текст',
            'short_text' => 'Вступительный текст',
            'publication' => 'Публикация',
            'indexation' => 'Индексация'
        ];
    }

    public function beforeSave($insert): bool
    {
        $this->alias = Inflector::slug($this->name);
        $this->tags = Json::encode($this->tags);

        return parent::beforeSave($insert);
    }

    /**
     * Gets query for [[Comments]].
     */
    public function getComments()
    {
        return $this->hasMany(Comment::class, ['article_id' => 'id']);
    }

    public static function getArticlesCount()
    {
        return Article::find()->count();
    }
}
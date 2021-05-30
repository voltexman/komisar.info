<?php


namespace backend\models;


use yii\db\ActiveRecord;
use yii\helpers\Inflector;

/**
 * @property mixed|null url
 */
class Interview extends ActiveRecord
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
        return '{{%interviews}}';
    }

    public function rules(): array
    {
        return [
            [['name', 'url'], 'required'],
            [['url'], 'unique'],
            [['text', 'meta_title', 'meta_keywords', 'meta_description'], 'string'],
            [['created_at'], 'default', 'value' => date('Y-m-d H:i:s')],
            [['publication', 'indexation'], 'boolean']
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'name' => 'Название интервью',
            'alias' => 'Псевдоним',
            'url' => 'YouTube ссылка',
            'text' => 'Описание',
            'publication' => 'Публикация',
            'indexation' => 'Индексация'
        ];
    }

    public function beforeSave($insert): bool
    {
        $this->alias = Inflector::slug($this->name);

        return parent::beforeSave($insert);
    }

    public function getVideoUrl($url): string
    {
        $array = explode('/', $url);

        return end($array);
    }

    public static function getInterviewsCount()
    {
        return Interview::find()->count();
    }
}
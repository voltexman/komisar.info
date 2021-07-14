<?php

namespace common\models;

/**
 * This is the model class for table "question".
 *
 * @property int $id
 * @property string $theme [varchar(255)]
 * @property string $created_at [datetime]
 */
class Sentence extends \yii\db\ActiveRecord
{
    const STATUS_NEW = 0;
    const STATUS_VIEWED = 1;

    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'sentences';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['theme'], 'required'],
            [['theme'], 'string', 'max' => 255],
            [['created_at'], 'default', 'value' => date('Y-m-d H:i:s')],
            [['status'], 'default', 'value' => self::STATUS_NEW]
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'theme' => 'Тема предложения'
        ];
    }
}

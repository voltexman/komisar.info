<?php

namespace common\models;

/**
 * This is the model class for table "question".
 *
 * @property int $id
 */
class Sentence extends \yii\db\ActiveRecord
{
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
            [['created_at'], 'default', 'value' => date('Y-m-d H:i:s')]
        ];
    }
}

<?php

namespace frontend\models;

/**
 * This is the model class for table "question".
 *
 * @property int $id
 * @property string $ip_address
 * @property int $article_id
 */
class Viewed extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'viewed';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['ip_address'], 'string'],
            [['article_id'], 'integer'],
            [['ip_address'], 'default', 'value' => \Yii::$app->request->userIP]
        ];
    }
}

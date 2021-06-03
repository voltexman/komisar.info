<?php

namespace common\models;

use JetBrains\PhpStorm\ArrayShape;
use Yii;

/**
 * This is the model class for table "visited_page".
 *
 * @property int $id
 * @property string|null $page
 * @property string|null $link
 * @property int|null $viewing_time
 * @property int $statistics_id
 * @property string $visited_at [datetime]
 */
class VisitedPage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'visited_page';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['viewing_time', 'statistics_id', 'viewing_time'], 'integer'],
            [['page'], 'string', 'max' => 255],
            [['visited_at'], 'default', 'value' => date('Y-m-d H:i:s')],
        ];
    }

    /**
     * {@inheritdoc}
     */
    #[ArrayShape(['id' => "string", 'ip' => "string", 'page' => "string", 'viewing_time' => "string"])]
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'ip' => 'Ip',
            'page' => 'Page',
            'viewing_time' => 'Viewing Time',
        ];
    }

    /**
     * Gets query for [[Statistics]].
     */
    public function getStatistic()
    {
        return $this->hasOne(Statistics::class, ['id' => 'statistics_id']);
    }
}

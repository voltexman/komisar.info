<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "statistics".
 *
 * @property int $id
 * @property string|null $ip
 * @property string|null $browser
 * @property string|null $device
 * @property string|null $os
 * @property string|null $city
 * @property string|null $type
 * @property string $visited_at [datetime]
 * @property string $latitude [varchar(255)]
 * @property string $longitude [varchar(255)]
 * @property string $accuracy [varchar(255)]
 *
 */
class Statistics extends \yii\db\ActiveRecord
{
    const DESKTOP = 'desktop';
    const MOBILE = 'mobile';

    const BOT = 'bot';
    const HUMAN = 'human';

    const REAL_PAGE = 1;
    const NOT_REAP_PAGE = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'statistics';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['ip', 'browser', 'device', 'os', 'city', 'type'], 'string', 'max' => 255],
            [['visited_at'], 'default', 'value' => date('Y-m-d H:i:s')],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'ip' => 'Ip',
            'browser' => 'Browser',
            'device' => 'Device',
            'os' => 'Os',
            'city' => 'City',
            'link' => 'Link',
        ];
    }

    /**
     * Gets query for [[Visited Pages]].
     */
    public function getPages()
    {
        return $this->hasMany(VisitedPage::class, ['statistics_id' => 'id']);
    }
}

<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "statistics".
 *
 * @property int $id
 * @property string|null $ip
 * @property string|null $browser
 * @property string|null $device
 * @property string|null $os
 * @property integer|null $status
 * @property string|null $city
 * @property string|null $type
 * @property string $visited_at [datetime]
 * @property string $latitude [varchar(255)]
 * @property string $longitude [varchar(255)]
 * @property string $accuracy [varchar(255)]
 *
 */
class Statistics extends ActiveRecord
{
    const DESKTOP = 'desktop';
    const MOBILE = 'mobile';

    const BOT = 'bot';
    const HUMAN = 'human';

    const STATUS_BOT = 0;
    const STATUS_UNKNOWN = 1;
    const STATUS_REAL = 2;

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['visited_at', 'visited_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['visited_at'],
                ],
                // если вместо метки времени UNIX используется datetime:
                // 'value' => new Expression('NOW()'),
                'value' => new Expression('NOW()')
            ],
        ];
    }

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
            [['ip', 'browser', 'device', 'os'], 'string', 'max' => 255],
            [['status'], 'integer']
//            [['visited_at'], 'default', 'value' => date('Y-m-d H:i:s')],
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

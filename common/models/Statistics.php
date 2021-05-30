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
 *
 */
class Statistics extends \yii\db\ActiveRecord
{
    const DESKTOP = 'desktop';
    const MOBILE = 'mobile';

    const BOT = 'bot';
    const HUMAN = 'human';

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
}

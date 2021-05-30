<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "visited_page".
 *
 * @property int $id
 * @property string|null $page
 * @property string|null $link
 * @property int|null $viewing_time
 * @property int $statistics_id
 */
class VisitedPage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'visited_page';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
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
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ip' => 'Ip',
            'page' => 'Page',
            'viewing_time' => 'Viewing Time',
        ];
    }
}

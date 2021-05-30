<?php


namespace frontend\models;


use yii\db\ActiveRecord;

/**
 * @property mixed|null name
 * @property int $id [int(11)]
 * @property string $email [varchar(255)]
 * @property string $text
 * @property string $created_at [datetime]
 * @property bool $status [tinyint(1)]
 */
class Contact extends ActiveRecord
{
    public $reCaptcha;

    const STATUS_SENT = 2;
    const STATUS_NEW = 1;
    const STATUS_VIEWED = 0;

    public static function tableName(): string
    {
        return '{{%contacts}}';
    }

    public function rules(): array
    {
        return [
            [['name', 'text'], 'required'],
            [['reCaptcha'], \himiklab\yii2\recaptcha\ReCaptchaValidator2::class,
                'uncheckedMessage' => 'Вкажіть що Ви не робот.'],
            [['email'], 'email'],
            [['created_at'], 'default', 'value' => date('Y-m-d H:i:s')],
            [['status'], 'default', 'value' => self::STATUS_NEW]
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'name' => 'Ім`я',
            'text' => 'Повідомлення',
            'created_at' => 'Отправлено'
        ];
    }

    public static function getMessagesCount()
    {
        return Contact::find()->count();
    }
}
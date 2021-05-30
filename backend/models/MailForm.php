<?php

namespace backend\models;

use yii\base\Model;

class MailForm extends Model
{
    public $subject;
    public $message;

    public function rules()
    {
        return [
            [['message'], 'required'],
            [['subject'], 'string']
        ];
    }

    public function attributeLabels()
    {
        return [
            'subject' => 'Тема письма',
            'message' => 'Ответ'
        ];
    }
}
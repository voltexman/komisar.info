<?php

namespace frontend\widgets;

use Yii;
use yii\base\Widget;

class ContactUs extends Widget
{
    public function run(): string
    {
        if (Yii::$app->controller->action->id != 'contact') {
            return $this->render('contact-us');
        }

        return false;
    }
}
<?php

use frontend\models\Contact;
use yii\widgets\DetailView;

/* @var $model Contact */

echo DetailView::widget([
    'model' => $model,
    'attributes' => [
        'name',
        'text'
    ],
]);
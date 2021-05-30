<?php

use frontend\models\Contact;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $message Contact */

$this->title = 'Сообщение от: ' . $message->name;
$this->params['breadcrumbs'][] = ['label' => 'Все сообщения', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $message->name, 'url' => ['view', 'id' => $message->id]];
?>
<div class="message-view">

    <div class="box">
        <div class="box-solid">
            <?= DetailView::widget([
                'model' => $message,
                'attributes' => [
                    [
                        'label' => 'Имя',
                        'attribute' => 'name'
                    ],
                    [
                        'label' => 'Сообщение',
                        'attribute' => 'text'
                    ],
                    'created_at:datetime',
                ],
            ]); ?>
        </div>
    </div>
</div>

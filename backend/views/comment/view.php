<?php

use common\models\Comment;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $comment Comment */

$this->title = 'Комментарий от: ' . $comment->name;
$this->params['breadcrumbs'][] = ['label' => 'Все комментарии', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $comment->name, 'url' => ['view', 'id' => $comment->id]];
?>
<div class="comment-view">

    <div class="box">
        <div class="box-">
            <?= DetailView::widget([
                'model' => $comment,
                'attributes' => [
                    [
                        'label' => 'Имя',
                        'attribute' => 'name'
                    ],
                    [
                        'label' => 'Статья',
                        'attribute' => ''
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

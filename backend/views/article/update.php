<?php

use backend\models\Article;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $model Article */

$this->title = 'Изменить статью: ' . StringHelper::truncateWords($model->name, 3);
$this->params['breadcrumbs'][] = ['label' => 'Все статьи', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => StringHelper::truncateWords($model->name, 3), 'url' => ['view', 'id' => $model->id]];
?>
<div class="product-update">

    <?= $this->render('_form', [
        'model' => $model,
        'action' => 'Сохранить статью'
    ]) ?>

</div>

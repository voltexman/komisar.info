<?php

use backend\models\Article;

/* @var $this yii\web\View */
/* @var $model Article */

$this->title = 'Изменить статью: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Все статьи', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
?>
<div class="product-update">

    <?= $this->render('_form', [
        'model' => $model,
        'action' => 'Сохранить статью'
    ]) ?>

</div>

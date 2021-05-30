<?php

use backend\models\Article;

/* @var $this yii\web\View */
/* @var $model Article */

$this->title = 'Добавить статью';
$this->params['breadcrumbs'][] = ['label' => 'Все статьи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-create">

    <?= $this->render('_form', [
        'model' => $model,
        'action' => 'Добавить статью'
    ]) ?>

</div>

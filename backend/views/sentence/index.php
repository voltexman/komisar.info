<?php

use kartik\dialog\Dialog;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

// widget with default options
echo Dialog::widget();

$this->title = 'Все предложения';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="sentence-index">
    <div class="box box-solid">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'summary' => false,
            'emptyText' => 'Предложений нет',
            'tableOptions' => ['class' => 'table table-striped table-bordered table-hover'],
            'columns' => ['theme', 'created_at']
        ]) ?>
    </div>
</div>

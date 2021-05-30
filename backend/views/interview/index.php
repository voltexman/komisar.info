<?php

use kartik\dialog\Dialog;
use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

// widget with default options
echo Dialog::widget();

$this->title = 'Все интервью';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="interview-index">

    <p><?= Html::a('Добавить интервью', ['create'], ['class' => 'btn btn-success btn-flat']) ?></p>

    <div class="box">
        <div class="box-solid">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'summary' => false,
                'columns' => [
                    [
                        'label' => 'Название интервью',
                        'attribute' => 'name',
                        'format' => 'raw',
                        'value' => function($data) {
                            return Html::a($data->name, Url::to(['interview/update', 'id' => $data->id]));
                        }
                    ],
                    [
                        'label' => 'Дата и время публикации',
                        'attribute' => 'created_at',
                        'headerOptions' => ['style' => 'width:250px'],
                        'visible' => !Yii::$app->devicedetect->isMobile(),
                        'format' => 'raw',
                        'value' => function ($data) {
                            return Html::tag('i', '&nbsp', ['class' => 'fa fa-calendar']) .
                                Yii::$app->formatter->asDate($data->created_at, 'long') . ' ' .
                                Html::tag('i', '&nbsp', ['class' => 'fa fa-clock-o']) .
                                Yii::$app->formatter->asTime($data->created_at, 'short');
                        }
                    ],
                    [
                        'class' => ActionColumn::class,
                        'header' => 'Действия',
                        'headerOptions' => ['style' => 'width:100px;text-align:center'],
                        'contentOptions' => ['style' => 'text-align:center'],
                        'template' => '{update} {delete}'
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>

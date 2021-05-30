<?php

/* @var $dataProvider Contact */

use frontend\models\Contact;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

?>
<div class="box box-solid">
    <div class="box-header with-border">
        <h3 class="box-title">Непрочитанные сообщения</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'emptyText' => 'Непрочитанных сообщений нет',
            'summary' => false,
            'columns' => [
                [
                    'label' => 'Имя',
                    'attribute' => 'name',
                    'format' => 'raw',
                    'value' => function ($data) {
                        return Html::a($data->name, Url::to(['message/view', 'id' => $data->id]));
                    }
                ],
                [
                    'label' => 'Почта',
                    'attribute' => 'email',
                ],
                [
                    'class' => '\dosamigos\grid\columns\LabelColumn',
                    'headerOptions' => ['style' => 'width:100px'],
                    'label' => 'Статус',
                    'attribute' => 'status',
                    'labels' => [
                        Contact::STATUS_NEW => [
                            'label' => 'Новое',
                            'options' => [
                                'class' => 'label-danger'
                            ]
                        ],
                        Contact::STATUS_VIEWED => [
                            'label' => 'Прочитано',
                            'options' => [
                                'class' => 'label-success'
                            ]
                        ]
                    ]
                ],
                [
                    'label' => 'Дата и время отправки',
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
            ],
        ]); ?>
    </div>
    <!-- /.box-body -->
    <div class="box-footer clearfix">
        <a href="<?= Url::to(['message/index']) ?>" class="btn btn-sm btn-info btn-flat pull-left">Сообщения</a>
    </div>
    <!-- /.box-footer -->
</div>

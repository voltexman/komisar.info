<?php

/* @var $dataProvider Statistics */

use blog\helpers\StatisticsHelper;
use common\models\Statistics;
use yii\bootstrap\Modal;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

?>

<?php Modal::begin([
    'options' => ['id' => 'statisticsDetails'],
    'header' => 'Детальная информация',
    'footer' => Html::button('Закрыть', ['class' => 'btn btn-primary btn-flat', 'onclick' => '$("#statisticsDetails").modal("hide")'])
]);

Modal::end();
?>

<div class="box box-solid statistics">
    <div class="box-header with-border pull-left">
        <h3 class="box-title">Посещаемость сайта</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body no-padding">
        <?php Pjax::begin() ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'emptyText' => 'Посетителей нет',
            'summary' => false,
            'columns' => [
                [
                    'label' => 'Дата',
                    'format' => 'raw',
                    'value' => function ($data) {
                        return !StatisticsHelper::isTodayDate($data->visited_at) ?
                            '<i class="fa fa-calendar"></i> ' .
                            Yii::$app->formatter->asDate($data->visited_at, 'short') :
                            '<i class="fa fa-clock-o"></i> ' .
                            Yii::$app->formatter->asTime($data->visited_at, 'short');
                    }
                ],
                [
                    'label' => 'ОС',
//                    'attribute' => 'os',
                    'format' => 'raw',
                    'value' => function ($data) {
                        return StatisticsHelper::getStatisticsIcon($data->os) . $data->os;
                    }
                ],
                [
                    'label' => 'Браузер',
                    'attribute' => 'browser'
                ],
                [
                    'label' => 'Устройство',
//                    'attribute' => 'device',
                    'format' => 'raw',
                    'value' => function ($data) {
                        return $data->device === Statistics::DESKTOP ?
                            '<i class="fa fa-desktop"></i> Компьютер' :
                            '<i class="fa fa-mobile"></i> Мобильный';
                    }
                ]
            ],
        ]); ?>
        <?php Pjax::end() ?>
    </div>
    <!-- /.box-body -->
    <div class="box-footer clearfix">
        <small class="text-muted">Всего: <b><?= $dataProvider->getTotalCount() ?></b></small>
        <small class="text-muted">Сегодня: <b><?= 0 ?></b></small>
        <small class="text-muted">Ботов: <b><?= StatisticsHelper::getTotalBotsCount() ?></b></small>
    </div>
    <!-- /.box-footer -->
</div>

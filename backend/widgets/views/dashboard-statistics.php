<?php

/* @var $dataProvider Statistics */

use blog\helpers\StatisticsHelper;
use common\models\Statistics;
use kartik\popover\PopoverX;
use yii\bootstrap\Modal;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;

$hintContent = '
<p><small class="text-primary"><i class="fa fa-users"></i> всего посетителей за всё время</small><br>
<small class="text-success"><i class="fa fa-user-plus"></i> новых посетителей за сегодня</small></p>';

?>

<?php Modal::begin([
    'options' => ['id' => 'statisticsDetails'],
    'header' => 'Детальная информация',
    'footer' => Html::button('Закрыть', [
        'class' => 'btn btn-primary btn-flat',
        'onclick' => '$("#statisticsDetails").modal("hide")'
    ])
]);

Modal::end();
?>

<?php Modal::begin([
    'options' => ['id' => 'charts'],
    'header' => 'Сравнение',
    'footer' => Html::button('Закрыть', [
        'class' => 'btn btn-primary btn-flat',
        'onclick' => '$("#charts").modal("hide")'
    ])
]);

Modal::end();
?>
<link rel="stylesheet"
      href="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.5.0/css/ol.css"
      type="text/css">
<script src="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.5.0/build/ol.js"></script>

<div class="box box-solid statistics">
    <div class="box-header with-border">
        <div class="pull-left">
            <i class="fa fa-users"></i>
            <h3 class="box-title">Посещаемость сайта</h3>
        </div>
        <div class="pull-right box-tools">
            <a class="btn btn-sm text-purple btn-chart">
                <i class="fa fa-pie-chart"></i>
                <?= !Yii::$app->devicedetect->isMobile() ? 'Сравнение' : null ?>
            </a>
            <a class="btn btn-sm text-purple">
                <i class="fa fa-search"></i>
                <?= !Yii::$app->devicedetect->isMobile() ? 'Найти' : null ?>
            </a>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body no-padding">
        <?php Pjax::begin(['timeout' => false]) ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'emptyText' => 'Посетителей нет',
            'tableOptions' => ['class' => 'table table-striped table-bordered table-hover'],
            'summary' => false,
            'layout' => '{items}',
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
                    'label' => 'Ip адрес',
                    'visible' => !Yii::$app->devicedetect->isMobile(),
                    'format' => 'raw',
                    'value' => function ($data) {
                        return '<i class="fa fa-globe"></i> ' . $data->ip;
                    }
                ],
                [
                    'label' => 'Город',
                    'format' => 'raw',
                    'value' => function ($data) {
                        return StatisticsHelper::getCityByIp($data->ip) ?
                            StatisticsHelper::getColorMarker($data->id) . StatisticsHelper::getCityByIp($data->ip) :
                            '<small class="text-muted"><b><i>неизвестно</i></b></small>';
                    }
                ],
                [
                    'label' => '',
                    'format' => 'raw',
                    'value' => function ($data) {
                        return '';
                    }
                ],
                [
                    'label' => 'ОС',
                    'format' => 'raw',
                    'visible' => !Yii::$app->devicedetect->isMobile(),
                    'value' => function ($data) {
                        return StatisticsHelper::getStatisticsIcon($data->os) . $data->os;
                    }
                ],
                [
                    'label' => 'Браузер',
                    'format' => 'raw',
                    'visible' => !Yii::$app->devicedetect->isMobile(),
                    'value' => function ($data) {
                        return StatisticsHelper::getStatisticsIcon($data->browser) . $data->browser;
                    }
                ],
                [
                    'label' => 'Устройство',
                    'format' => 'raw',
                    'visible' => !Yii::$app->devicedetect->isMobile(),
                    'value' => function ($data) {
                        return $data->device === Statistics::DESKTOP ?
                            '<i class="fa fa-desktop"></i> Компьютер' :
                            '<i class="fa fa-mobile"></i> Мобильный';
                    }
                ],
                [
                    'label' => 'Медиа',
                    'format' => 'raw',
                    'visible' => Yii::$app->devicedetect->isMobile(),
                    'value' => function ($data) {
                        return StatisticsHelper::getStatisticsIcon($data->os) . ' ' .
                            StatisticsHelper::getStatisticsIcon($data->browser) . ' ' .
                            StatisticsHelper::getStatisticsIcon($data->device);
                    }
                ]
            ],
        ]); ?>
        <?= LinkPager::widget([
            'pagination' => $dataProvider->getPagination(),
            'options' => ['class' => 'pagination pagination-sm no-margin pull-right']
        ]) ?>
        <?php Pjax::end() ?>
    </div>
    <!-- /.box-body -->
    <div class="box-footer clearfix">
        <small class="text-primary">
            <i class="fa fa-users"></i>
            <b><?= $dataProvider->getTotalCount() ?></b>
        </small>
        <small class="text-success">
            <i class="fa fa-user-plus"></i>
            <b><?= StatisticsHelper::getTodayVisitedCount() ?></b>
        </small>
        <small class="text-danger">
            <i class="fa fa-bug"></i>
            <b><?= StatisticsHelper::getTotalBotsCount() ?></b>
        </small>
        <small class="text-muted">
            <i class="fa fa-question-circle"></i>
            <b><?= StatisticsHelper::getTotalUnknownCount() ?></b>
        </small>

        <?= PopoverX::widget([
            'header' => 'Подсказка',
            'placement' => PopoverX::ALIGN_TOP_RIGHT,
            'content' => $hintContent,
//            'size' => PopoverX::SIZE_MEDIUM,
            'toggleButton' => [
                'tag' => 'small',
                'label' => '<i class="fa fa-info-circle"></i>',
                'class' => 'text-muted pull-right'
            ],
        ]); ?>
    </div>
    <!-- /.box-footer -->
</div>

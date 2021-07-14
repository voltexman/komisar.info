<?php

/* @var $dataProvider Statistics */

/* @var $searchModel SearchStatistic */

use backend\models\SearchStatistic;
use blog\helpers\StatisticsHelper;
use common\models\Statistics;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\bootstrap\Modal;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;

$this->title = 'Статистика';

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

<link rel="stylesheet"
      href="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.5.0/css/ol.css"
      type="text/css">
<script src="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.5.0/build/ol.js"></script>

<div class="row">
    <div class="col-md-3 col-sm-6 col-xs-6">
        <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Всего</span>
                <span class="info-box-number"><?= StatisticsHelper::getTotalVisitorsCount() ?></span>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-6">
        <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-user-plus"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Сегодня</span>
                <span class="info-box-number"><?= StatisticsHelper::getTodayVisitedCount() ?></span>
            </div>
        </div>
    </div>

    <div class="clearfix visible-sm-block"></div>

    <div class="col-md-3 col-sm-6 col-xs-6">
        <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-bug"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Ботов</span>
                <span class="info-box-number"><?= StatisticsHelper::getTotalBotsCount() ?></span>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-6">
        <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-question-circle"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Подозрительных</span>
                <span class="info-box-number"><?= StatisticsHelper::getTotalUnknownCount() ?></span>
            </div>
        </div>
    </div>
</div>

<?php $form = ActiveForm::begin(['method' => 'GET']) ?>
<div class="row">
    <div class="col-md-12">
        <div class="box box-solid collapsed-box">
            <div class="box-header with-border">
                <i class="fa fa-search"></i>
                <h3 class="box-title">Поиск посетителей</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse">
                        <i class="fa fa-plus"></i>
                    </button>
                </div>
            </div>
            <div class="box-body" style="display: <?= Yii::$app->request->queryParams ? 'block' : 'none' ?>;">
                <div class="row">
                    <div class="col-sm-4">
                        <?= $form->field($searchModel, 'os')
                            ->widget(Select2::class, [
                                'data' => StatisticsHelper::getOsList(),
                                'theme' => Select2::THEME_DEFAULT,
                                'options' => ['placeholder' => 'Выберите операционную систему ...', 'multiple' => false],
                                'hideSearch' => false
                            ]) ?>
                    </div>
                    <div class="col-sm-4">
                        <?= $form->field($searchModel, 'browser')
                            ->widget(Select2::class, [
                                'data' => StatisticsHelper::getBrowserList(),
                                'theme' => Select2::THEME_DEFAULT,
                                'options' => ['placeholder' => 'Выберите браузер ...', 'multiple' => false],
                                'hideSearch' => false
                            ]) ?>
                    </div>
                    <div class="col-sm-4">
                        <?= $form->field($searchModel, 'device')
                            ->widget(Select2::class, [
                                'data' => StatisticsHelper::getDeviceList(),
                                'theme' => Select2::THEME_DEFAULT,
                                'options' => ['placeholder' => 'Выберите устройство ...', 'multiple' => false],
                                'hideSearch' => false
                            ]) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <?= '<label class="control-label">Период посещения</label>';
                            echo DatePicker::widget([
                                'model' => $searchModel,
                                'language' => 'ru',
                                'attribute' => 'from_date',
                                'attribute2' => 'to_date',
                                'options' => ['placeholder' => 'Начальная дата'],
                                'options2' => ['placeholder' => 'Конечная дата'],
                                'type' => DatePicker::TYPE_RANGE,
                                'form' => $form,
                                'pluginOptions' => [
                                    'format' => 'yyyy-mm-dd',
                                    'autoclose' => true,
                                ]
                            ]) ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <?= $form->field($searchModel, 'returns')
                            ->textInput([
                                'type' => 'number',
                                'min' => 0,
                                'max' => StatisticsHelper::maxReturns()
                            ])
                            ->hint('от 0 до ' . StatisticsHelper::maxReturns()) ?>
                    </div>
                    <div class="col-sm-4">
                        <?= $form->field($searchModel, 'transitions')
                            ->textInput([
                                'type' => 'number',
                                'min' => 0,
                                'max' => StatisticsHelper::maxTransitions()
                            ])
                        ->hint('от 0 до ' . StatisticsHelper::maxTransitions()) ?>
                    </div>
                </div>
            </div>
            <div class="box-footer clearfix" style="display: <?= Yii::$app->request->queryParams ? 'block' : 'none' ?>;">
                <div class="btn-group">
                    <?= Html::submitButton('Найти', ['class' => 'btn bg-purple']) ?>
                    <?= Html::a('Сбросить', Url::to(['statistic/index']), ['class' => 'btn bg-orange']) ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php ActiveForm::end() ?>

<?php Pjax::begin(['timeout' => false]) ?>
<div class="box box-solid statistics">
    <div class="box-header with-border">
        <div class="pull-left">
            <i class="fa fa-users"></i>
            <h3 class="box-title">Посетители сайта</h3>
        </div>
    </div>
    <div class="box-body no-padding">
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
    </div>
    <!-- /.box-body -->
    <div class="box-footer clearfix">
        <?= LinkPager::widget([
            'pagination' => $dataProvider->getPagination(),
            'options' => ['class' => 'pagination pagination-sm no-margin pull-right']
        ]) ?>
    </div>
    <!-- /.box-footer -->
</div>
<?php Pjax::end() ?>

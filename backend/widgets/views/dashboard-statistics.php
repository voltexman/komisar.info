<?php

/* @var $dataProvider Contact */

use blog\helpers\StatisticsHelper;
use common\models\Statistics;
use frontend\models\Contact;
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
                    'label' => 'IP адрес',
                    'attribute' => 'ip'
                ],
                [
                    'label' => 'ОС',
                    'attribute' => 'os'
                ],
                [
                    'label' => 'Браузер',
                    'attribute' => 'browser'
                ],
                [
                    'label' => 'Устройство',
                    'attribute' => 'device',
                    'value' => function ($data) {
                        return $data->device === Statistics::DESKTOP ? 'Компьютер' : 'Мобильный';
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

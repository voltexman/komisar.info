<?php

/* @var $pages VisitedPage */

/* @var $statistics Statistics */

use blog\helpers\ArticleHelper;
use blog\helpers\StatisticsHelper;
use common\models\Statistics;
use common\models\VisitedPage;
use yii\widgets\DetailView;

$this->registerCss('
img.olTileImage {
      -webkit-transform:inherit;
    -moz-transform: inherit;
    -o-transform:inherit ;
    -ms-transform: inherit;
    transform:inherit ;
    -webkit-backface-visibility: inherit;
    -moz-backface-visibility:inherit ;
    -ms-backface-visibility:inherit ;
    backface-visibility:inherit ;
    -webkit-perspective:inherit ;
    -moz-perspective:inherit ;
    -ms-perspective:inherit ;
    perspective:inherit ;

}
');
$this->registerJs("
                const iconFeature = new ol.Feature({
                    geometry: new ol.geom.Point(ol.proj.fromLonLat([$statistics->longitude, $statistics->latitude])),
                    name: 'Somewhere near Nottingham',
                });

                const map = new ol.Map({
                    target: 'map',
                    controls: [new ol.control.FullScreen()],
                    layers: [
                        new ol.layer.Tile({
                            source: new ol.source.OSM(),
                        }),
                        new ol.layer.Vector({
                            source: new ol.source.Vector({
                                features: [iconFeature]
                            }),
                            style: new ol.style.Style({
                                image: new ol.style.Icon({
                                    anchor: [0.5, 46],
                                    anchorXUnits: 'fraction',
                                    anchorYUnits: 'pixels',
                                    src: 'https://openlayers.org/en/latest/examples/data/icon.png'
                                })
                            })
                        })
                    ],
                    view: new ol.View({
                        center: ol.proj.fromLonLat([$statistics->longitude, $statistics->latitude]),
                        zoom: 16
                    })
                });
")

?>

<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_1" data-toggle="tab">Информация</a></li>
        <li><a href="#tab_2" data-toggle="tab">Страницы</a></li>
        <li><a href="#tab_3" data-toggle="tab">Геолокация</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="tab_1">
            <b>Данные о посетителе</b>

            <?= DetailView::widget([
                'model' => $statistics,
                'attributes' => [
                    [
                        'label' => 'Дата',
                        'value' => function ($data) {
                            return Yii::$app->formatter->asDate($data->visited_at, 'long') . ' в ' .
                                Yii::$app->formatter->asTime($data->visited_at, 'short');
                        }
                    ],
                    'ip',
                    [
                        'label' => 'Город',
                        'format' => 'raw',
                        'value' => function ($data) {
                            $country = StatisticsHelper::getCountryByIp($data->ip);
                            $city = StatisticsHelper::getCityByIp($data->ip);

                            if ($country !== 'Ukraine' && !empty($city)) {
                                return $city . '<small class="text-danger"><b><i> (предположительно)</i></b></small>';
                            } elseif (empty($city)) {
                                return '<small class="text-muted"><b><i>неизвестно</i></b></small>';
                            }

                            return $city;
                        }
                    ],
                    [
                        'label' => 'Страниц',
                        'value' => function ($data) {
                            $count = StatisticsHelper::getVisitedPagesCount($data->id);
                            return $count . ' ' . ArticleHelper::plural($count, ['переход', 'перехода', 'переходов']);
                        }
                    ],
                    [
                        'label' => 'Общее время',
                        'value' => function ($data) {
                            return '';
                        }
                    ]
                ]
            ]) ?>
            лайков 0. в избранное 0. комментариев 0. поделился 0
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="tab_2">
            <?php if ($pages) : ?>
                <ul class="timeline">
                    <?php foreach ($pages as $page) : ?>
                        <li class="time-label">
                            <span class="bg-red">
                                <?= Yii::$app->formatter->asDate($page->visited_at, 'long') ?> в
                                <?= Yii::$app->formatter->asTime($page->visited_at, 'short') ?>
                            </span>
                        </li>
                        <li>
                            <i class="fa fa-file-text bg-blue"></i>
                            <div class="timeline-item">
                            <span class="time">
                                <i class="fa fa-clock-o"></i>
                                <?= $page->viewing_time ? gmdate('i:s', $page->viewing_time) : 'неизвестно' ?>
                            </span>
                                <h3 class="timeline-header">
                                    <a href="#"><?= StatisticsHelper::getRealName($page->page) ?></a>
                                </h3>

                                <div class="timeline-body">
                                    <span class="text-muted">
                                        <i class="fa fa-check-circle"></i> Поставил лайк
                                    </span><br>
                                    <span class="text-muted">
                                        <i class="fa fa-check-circle"></i> Добавил в избранное
                                    </span><br>
                                    <span class="text-muted">
                                        <i class="fa fa-check-circle"></i> Прокомментировал
                                    </span><br>
                                    <span class="text-muted">
                                        <i class="fa fa-check-circle"></i> Поделился
                                    </span>
                                </div>

                                <div class="timeline-footer"></div>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p class="text-center text-muted">Посещённых страниц нету</p>
            <?php endif; ?>
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="tab_3">
            <div id="map" class="map" style="width:100%; height:400px"></div>
        </div>
    </div>
</div>


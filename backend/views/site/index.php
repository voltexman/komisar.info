<?php

/* @var $this yii\web\View */

use backend\models\Article;
use backend\widgets\DashboardDevicesStatisticsPie;
use backend\widgets\DashboardLatestMessagesList;
use backend\widgets\DashboardStatistics;
use blog\helpers\ArticleHelper;
use dosamigos\chartjs\ChartJs;
use frontend\models\Contact;
use yii\helpers\Url;

$this->title = 'Панель управления';
?>

<div class="row">
    <div class="col-lg-4 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>
                    <?= Article::getArticlesCount() ?>
                    <?php if (!Yii::$app->devicedetect->isMobile()) : ?>
                        <sup class="text-sm">
                            <?= ArticleHelper::plural(Article::getArticlesCount(), ['статья', 'статьи', 'статей']) ?>
                        </sup>
                    <?php endif; ?>
                </h3>

                <span><?= ArticleHelper::getPublicArticleCount() ?> опубликовано</span><br>
                <span><?= ArticleHelper::getIndexationArticleCount() ?> индексируется</span>
            </div>
            <div class="icon">
                <i class="fa fa-file-text-o"></i>
            </div>
            <a href="<?= Url::to(['article/index']) ?>" class="small-box-footer">Статьи
                <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-4 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3>
                    <?= ArticleHelper::getTotalCommentsCount() ?>
                    <?php if (!Yii::$app->devicedetect->isMobile()) : ?>
                        <sup class="text-sm">
                            <?= ArticleHelper::plural(ArticleHelper::getTotalCommentsCount(), ['комментарий', 'комментария', 'комментариев']) ?>
                        </sup>
                    <?php endif; ?>
                </h3>

                <span>2 статьи</span><br>
                <span>500 лайков</span>
            </div>
            <div class="icon">
                <i class="fa fa-comment"></i>
            </div>
            <a href="<?= Url::to(['comment/index']) ?>" class="small-box-footer">Комментарии
                <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-4 col-xs-12">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3><?= Contact::getMessagesCount() ?></h3>

                <p>Сообщений</p>
            </div>
            <div class="icon">
                <i class="fa fa-envelope-o"></i>
            </div>
            <a href="<?= Url::to(['message/index']) ?>" class="small-box-footer">Сообщения
                <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>

<div class="row">
    <div class="col-lg-8">
        <?= DashboardLatestMessagesList::widget() ?>
    </div>
    <div class="col-lg-4">
        <?= DashboardDevicesStatisticsPie::widget() ?>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <?= DashboardStatistics::widget() ?>
        <link rel="stylesheet"
              href="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.5.0/css/ol.css"
              type="text/css">
        <script src="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.5.0/build/ol.js"></script>
        <div id="map" class="map" style="width:100%; height:400px"></div>
        <script type="text/javascript">

            // const iconFeature = new ol.Feature({
            //     geometry: new ol.geom.Point(ol.proj.fromLonLat([28.4262036, 49.2217985])),
            //     name: 'Somewhere near Nottingham',
            // });
            //
            // const map = new ol.Map({
            //     target: 'map',
            //     controls: [new ol.control.FullScreen()],
            //     layers: [
            //         new ol.layer.Tile({
            //             source: new ol.source.OSM(),
            //         }),
            //         new ol.layer.Vector({
            //             source: new ol.source.Vector({
            //                 features: [iconFeature]
            //             }),
            //             style: new ol.style.Style({
            //                 image: new ol.style.Icon({
            //                     anchor: [0.5, 46],
            //                     anchorXUnits: 'fraction',
            //                     anchorYUnits: 'pixels',
            //                     src: 'https://openlayers.org/en/latest/examples/data/icon.png'
            //                 })
            //             })
            //         })
            //     ],
            //     view: new ol.View({
            //         center: ol.proj.fromLonLat([28.4262036, 49.2217985]),
            //         zoom: 16
            //     })
            // });

        </script>
    </div>
</div>

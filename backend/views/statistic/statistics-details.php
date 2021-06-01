<?php

/* @var $pages VisitedPage */

/* @var $statistics Statistics */

use blog\helpers\StatisticsHelper;
use common\models\Statistics;
use common\models\VisitedPage;
use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\Map;


?>

<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_1" data-toggle="tab">Информация</a></li>
        <li><a href="#tab_2" data-toggle="tab">Страницы</a></li>
        <li><a href="#tab_3" data-toggle="tab">Геолокация</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="tab_1">
            <b>How to use:</b>

            <p>Exactly like the original bootstrap tabs except you should use
                the custom wrapper <code>.nav-tabs-custom</code> to achieve this style.</p>
            A wonderful serenity has taken possession of my entire soul,
            like these sweet mornings of spring which I enjoy with my whole heart.
            I am alone, and feel the charm of existence in this spot,
            which was created for the bliss of souls like mine. I am so happy,
            my dear friend, so absorbed in the exquisite sense of mere tranquil existence,
            that I neglect my talents. I should be incapable of drawing a single stroke
            at the present moment; and yet I feel that I never was a greater artist than now.
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
            <!--            --><?php
            //            $coord = new LatLng([
            //                'lat' => $statistics->latitude,
            //                'lng' => $statistics->longitude
            //            ]);
            //            $map = new Map([
            //                'center' => $coord,
            //                'zoom' => 14
            //            ]);
            //            echo $map->display();
            //            ?>
            <?= \elektromann\openlayers\Map::widget([
                'center' => [$statistics->longitude, $statistics->latitude],
                'zoom' => 16,
                'markers' => [
                    [
                        'center' => 'here',
                        'title' => "Bond street here", //Title of the marker
                        'description' => "You can see Bond street", //Show wher one click on marker
                    ],
                ],
                'fullScreenButton' => true,
                'boxHeight' => '400px',
                'boxWidth' => '100%'
            ]); ?>
        </div>
        <!-- /.tab-pane -->
    </div>
    <!-- /.tab-content -->
</div>


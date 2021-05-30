<?php

/* @var $pages VisitedPage */

use common\models\VisitedPage;
?>

<ul class="timeline">

    <?php foreach ($pages as $page) : ?>
        <!-- timeline time label -->
        <li class="time-label">
        <span class="bg-red">
            <?= Yii::$app->formatter->asDate($page->visited_at, 'long') ?> в
            <?= Yii::$app->formatter->asTime($page->visited_at, 'short') ?>
        </span>
        </li>
        <!-- /.timeline-label -->

        <!-- timeline item -->
        <li>
            <!-- timeline icon -->
            <i class="fa fa-file-text bg-blue"></i>
            <div class="timeline-item">
                <span class="time">
                    <i class="fa fa-clock-o"></i>
                    <?= $page->viewing_time ? gmdate('i:s', $page->viewing_time) : 'неизвестно' ?>
                </span>

                <h3 class="timeline-header"><a href="#"><?= $page->page ?></a></h3>

                <div class="timeline-body">
                    <span class="text-muted"><i class="fa fa-check-circle"></i> Поставил лайк</span><br>
                    <span class="text-muted"><i class="fa fa-check-circle"></i> Добавил в избранное</span><br>
                    <span class="text-muted"><i class="fa fa-check-circle"></i> Прокомментировал</span><br>
                    <span class="text-muted"><i class="fa fa-check-circle"></i> Поделился</span>
                </div>

                <div class="timeline-footer"></div>
            </div>
        </li>
        <!-- END timeline item -->
    <?php endforeach; ?>

</ul>

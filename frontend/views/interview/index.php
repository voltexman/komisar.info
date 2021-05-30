<?php

/* @var $dataProvider Interview */

use backend\models\Interview;
use frontend\widgets\SidebarLatestArticles;
use yii\helpers\Url;
use yii\widgets\LinkPager;

$this->title = 'Інтерв`ю Komisar.Info';
?>
<section class="blog-posts grid-system">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="all-blog-posts">
                    <div class="row">
                        <?php if ($dataProvider->getModels()) : ?>
                            <?php foreach ($dataProvider->getModels() as $interview) : ?>
                                <div class="col-md-6 col-sm-6">
                                    <div class="blog-post">
                                        <div class="blog-thumb">
                                            <iframe width="100%" height="250"
                                                    src="https://www.youtube.com/embed/<?= $interview->getVideoUrl($interview->url) ?>"
                                                    frameborder="0"
                                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                    allowfullscreen></iframe>
                                        </div>
                                        <div class="down-content">
                                            <a href="<?= Url::to(['interview/view', 'alias' => $interview->alias]) ?>">
                                                <h4><?= $interview->name ?></h4></a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>Матеріалів немає</p>
                        <?php endif; ?>
                        <div class="col-lg-12">
                            <?= LinkPager::widget([
                                'pagination' => $dataProvider->pagination,
                                'options' => [
                                    'class' => 'page-numbers',
                                ]
                            ]); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="sidebar">
                    <div class="row">
                        <div class="col-lg-12">
                            <?= SidebarLatestArticles::widget() ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

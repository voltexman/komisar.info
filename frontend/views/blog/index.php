<?php

/* @var $dataProvider Article */

use backend\models\Article;
use frontend\widgets\SidebarLatestInterview;
use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\helpers\Url;
use yii\widgets\LinkPager;

$this->title = 'Блог Komisar.Info';
$this->registerMetaTag(['name' => 'robots', 'content' => 'all']);
?>
<section class="blog-posts grid-system">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="all-blog-posts">
                    <div class="row">
                        <?php if ($dataProvider->getModels()) : ?>
                            <?php foreach ($dataProvider->getModels() as $article) : ?>
                                <div class="col-lg-6">
                                    <div class="blog-post">
                                        <div class="blog-thumb">
                                            <a href="<?= Url::to(['blog/view', 'alias' => $article->alias]) ?>">
                                                <?= $article->image ? Html::img($article->getThumbFileUrl('image', 'blog_thumb')) : Html::img('/images/no_image.jpg', ['alt' => 'No image']) ?>
                                            </a>
                                        </div>
                                        <div class="down-content">
                                            <a href="<?= Url::to(['blog/view', 'alias' => $article->alias]) ?>">
                                                <h4><?= StringHelper::truncate($article->name, '35') ?></h4></a>

                                            <p class="line"></p>

                                            <p><?= StringHelper::truncate($article->short_text, '80') ?></p>

                                            <ul class="post-info">
                                                <li><a href="#"><i
                                                                class="fa fa-calendar"></i> <?= Yii::$app->formatter->asDate($article->created_at, 'short') ?>
                                                    </a></li>
                                            </ul>
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
                            <?= SidebarLatestInterview::widget() ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

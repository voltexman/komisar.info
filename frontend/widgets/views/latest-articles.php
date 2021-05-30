<?php

/* @var $dataProvider Article */

use backend\models\Article;
use blog\helpers\ArticleHelper;
use yii\helpers\Url;

?>
<div class="related-posts">
    <div class="post-module-3">
        <div class="widget-header-2 position-relative mt-30">
            <h5 class="mt-5 mb-30">Останні статті</h5>
        </div>
        <div class="loop-list loop-list-style-1">
            <?php foreach ($dataProvider->getModels() as $article) : ?>
                <article class="hover-up-2 transition-normal wow fadeInUp  animated" id="<?= $article->id ?>">
                    <div class="row mb-40 list-style-2">
                        <div class="col-md-4">
                            <div class="post-thumb position-relative border-radius-5">
                                <div class="img-hover-slide border-radius-5 position-relative"
                                     style="background-image: url(<?= $article->image ? $article->getThumbFileUrl('image', 'blog_thumb') : '/images/no_image.jpg' ?>)">
                                    <a class="img-link" href="<?= $article->alias ?>"></a>
                                </div>
                                <div class="main-page">
                                <?= \ymaker\social\share\widgets\SocialShare::widget([
                                    'configurator' => 'socialShare',
                                    'url' => Url::to($article->alias, true),
                                    'title' => $article->meta_title,
                                    'description' => $article->meta_description,
                                    'imageUrl' => Url::to($article->getThumbFileUrl('image', 'blog_full'), true),
                                    'containerOptions' => ['tag' => 'ul', 'class' => 'social-share']
                                ]); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 align-self-center">
                            <div class="post-content">
                                <div class="entry-meta meta-0 font-small mb-10">
                                    <?= ArticleHelper::getArticleStatus($article->alias) ?>
                                </div>
                                <h5 class="post-title font-weight-900 mb-10">
                                    <a href="<?= $article->alias ?>"><?= $article->name ?></a>
                                    <span class="post-format-icon btn-favorite cursor-pointer">
                                        <i class="elegant-icon <?= ArticleHelper::inFavorite($article->id) ? 'icon_star' : 'icon_star_alt' ?>"></i>
                                    </span>
                                </h5>
                                <div class="entry-meta meta-1 float-left font-x-small text-uppercase">
                                    <span class="post-on">
                                        <i class="elegant-icon icon_calendar"></i>
                                        <?= Yii::$app->formatter->asDate($article->created_at, 'long') ?>
                                    </span>
                                    <span class="time-reading has-dot">
                                        <i class="elegant-icon icon_comment"></i>
                                        <?= ArticleHelper::getCommentsCountById($article->id) ?>
                                    </span>
                                    <span class="post-by has-dot">
                                        <i class="elegant-icon icon_heart"></i>
                                        <?= ArticleHelper::likeCount($article->id) ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</div>
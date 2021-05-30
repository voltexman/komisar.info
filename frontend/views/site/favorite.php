<?php

/* @var $this yii\web\View */

/* @var $dataProvider Article */

use backend\models\Article;
use blog\helpers\ArticleHelper;
use kop\y2sp\ScrollPager;
use yii\helpers\Url;

$this->title = Yii::$app->name;
$this->registerMetaTag(['name' => 'robots', 'content' => 'none']);
?>

<div class="bg-grey pt-30 pb-30">
    <div class="container">
        <div class="post-module-2">
            <div class="loop-list loop-list-style-1">

                <div class="row">
                    <div class="col-sm-12 mb-20">
                        <span>Вами обрано:
                            <b><?= $dataProvider->getTotalCount() . ' ' . ArticleHelper::plural($dataProvider->getTotalCount(), ['стаття', 'статті', 'статей']) ?></b
                        </span>
                    </div>
                </div>

                <?php if ($dataProvider->getModels()) : ?>
                    <div class="row">
                        <?php foreach ($dataProvider->getModels() as $model) : ?>
                            <article class="col-md-4 mb-40 wow fadeInUp  animated" id="<?= $model->id ?>">
                                <div class="post-card-1 border-radius-10 hover-up">
                                    <div class="post-thumb thumb-overlay img-hover-slide position-relative"
                                         style="background-image: url(<?= $model->image ? $model->getThumbFileUrl('image', 'blog_thumb') : '/images/no_image.jpg' ?>)">
                                        <a class="img-link" href="<?= $model->alias ?>"></a>
                                        <span class="top-right-icon bg-info mr-40 btn-like cursor-pointer">
                                            <i class="elegant-icon <?= ArticleHelper::hasLike($model->id) ? 'icon_heart' : 'icon_heart_alt' ?>"></i>
                                        </span>
                                        <span class="top-right-icon bg-danger btn-favorite-remove cursor-pointer">
                                            <i class="elegant-icon icon_trash"></i>
                                        </span>
                                        <div class="main-page">
                                            <?= \ymaker\social\share\widgets\SocialShare::widget([
                                                'configurator' => 'socialShare',
                                                'url' => Url::to($model->alias, true),
                                                'title' => $model->meta_title,
                                                'description' => $model->meta_description,
                                                'imageUrl' => Url::to($model->getThumbFileUrl('image', 'blog_full'), true),
                                                'containerOptions' => ['tag' => 'ul', 'class' => 'social-share']
                                            ]); ?>
                                        </div>
                                    </div>
                                    <div class="post-content p-30">
                                        <div class="entry-meta meta-0 font-small mb-10 text-limit-1-row">
                                            <?= ArticleHelper::getArticleStatus($model->alias) ?>
                                        </div>
                                        <div class="d-flex post-card-content">
                                            <h5 class="post-title mb-20 font-weight-500 <?= !Yii::$app->devicedetect->isMobile() ? 'text-limit-2-row' : null ?>">
                                                <a href="<?= $model->alias ?>"><?= $model->name ?></a>
                                            </h5>
                                            <div class="post-excerpt mb-25 font-small text-muted text-limit-3-row">
                                                <p><?= $model->short_text ?></p>
                                            </div>
                                            <div class="entry-meta meta-1 float-left font-x-small text-uppercase">
                                                <span class="post-on">
                                                    <i class="elegant-icon icon_calendar"></i>
                                                    <?= Yii::$app->formatter->asDate($model->created_at, 'long') ?>
                                                </span>
                                                <span class="time-reading has-dot">
                                                    <i class="elegant-icon icon_comment"></i>
                                                    <?= ArticleHelper::getCommentsCountById($model->id) ?>
                                                </span>
                                                <span class="post-by has-dot">
                                                    <i class="elegant-icon icon_heart"></i>
                                                    <?= ArticleHelper::likeCount($model->id) ?>
                                                </span>
                                                <span class="post-by has-dot">
                                                    <i class="elegant-icon icon_profile"></i>
                                                    <?= ArticleHelper::getViewedCount($model->id) ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="send-info p-30 border-radius-10 wow fadeIn  animated bg-info text-white position-relative">
                        <i class="elegant-icon icon_info position-absolute info-icon"></i>
                        <p class="font-medium">Сторінка для відображення обранних матеріалів. Для розміщення до
                            списку обранних, на тій чи іншій статті, необхідно натиснути зірочку
                            <i class="elegant-icon icon_star_alt"></i> після чого знову перейти на данну сторінку.
                        </p>
                    </div>
                <?php endif; ?>

                <?= ScrollPager::widget([
                    'pagination' => $dataProvider->getPagination(),
                    'item' => 'article',
                    'container' => '.loop-list',
                    'triggerText' => 'Показати ще',
                    'triggerTemplate' => '<div class="text-center col-md-12"><button class="btn button center-block reveal-btn">{text} <i class="elegant-icon icon_refresh"></i></button></div>',
                    'next' => '.next a',
                    'paginationSelector' => '.container .pagination',
                    'noneLeftText' => '',
                    'noneLeftTemplate' => '',
                    'spinnerSrc' => '',
                    'spinnerTemplate' => '',
                    'enabledExtensions' => [
                        ScrollPager::EXTENSION_TRIGGER,
                        ScrollPager::EXTENSION_SPINNER,
                        ScrollPager::EXTENSION_NONE_LEFT,
                        ScrollPager::EXTENSION_PAGING,
                    ],
                    'eventOnRendered' => "function() {
                            $('.main-page > .social-share > li.first-position').remove();
                            $('.main-page > .social-share').prepend('<li class=\"first-position\"><a><i class=\"elegant-icon social_share\"></i></a></li>')
                        }"
                ]) ?>
            </div>
        </div>
    </div>
</div>
</div>

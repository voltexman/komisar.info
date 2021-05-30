<?php

/* @var $article Article */

/* @var $comments Comment */

use backend\models\Article;
use blog\helpers\ArticleHelper;
use common\models\Comment;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

$this->title = $article->name;
$this->registerMetaTag(['name' => 'keywords', 'content' => $article->meta_keywords]);
$this->registerMetaTag(['name' => 'description', 'content' => $article->meta_description]);
$this->registerMetaTag(['name' => 'robots', 'content' => $article->indexation ? 'all' : 'none']);

?>

<div class="container single-content article" data-real-id="<?= $realId ?>">
    <?php if ($article->image) : ?>
        <div class="entry-header pt-30 pb-30 mb-20">
            <div class="row">
                <div class="col-md-6 mb-md-0 mb-sm-3">
                    <figure class="mb-0 mt-lg-0 mt-3 border-radius-5" id="<?= $article->id ?>">
                        <img class=" border-radius-5" src="<?= $article->getThumbFileUrl('image', 'blog_full') ?>"
                             alt="<?= $article->meta_title ?>">
                        <span class="top-right-icon bg-info btn-like cursor-pointer">
                        <i class="elegant-icon <?= ArticleHelper::hasLike($article->id) ? 'icon_heart' : 'icon_heart_alt' ?>"></i>
                    </span>
                    </figure>
                </div>
                <div class="col-md-6 align-self-center">
                    <div class="post-content">
                        <h1 class="entry-title mb-30 font-weight-600">
                            <?= $article->name ?>
                        </h1>
                        <p class="excerpt mb-30">
                            <?= $article->short_text ?>
                        </p>
                        <div class="entry-meta align-items-center meta-2 font-small color-muted">
                        <span class="mr-10"><i class="elegant-icon icon_calendar"></i>
                            <?= Yii::$app->formatter->asDate($article->created_at, 'long') ?></span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    <?php else: ?>
        <div class="entry-header entry-header-style-1 mb-50 pt-50">
            <h1 class="entry-title mb-30 font-weight-600">
                <?= $article->name ?>
            </h1>
            <div class="row">
                <div class="col-md-6">
                    <div class="entry-meta align-items-center meta-2 font-small color-muted">
                        <span class="mr-10"><i class="elegant-icon icon_calendar"></i>
                            <?= Yii::$app->formatter->asDate($article->created_at, 'long') ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <?php if (Yii::$app->devicedetect->isMobile()) : ?>
        <hr class="wp-block-separator is-style-wide">
    <?php endif; ?>
    <!--end single header-->
    <!--figure-->
    <article class="entry-wraper mb-50">
        <div class="entry-main-content wow fadeIn animated">
            <div class="content-place overflow-hidden">
                <?= $article->text ?>
            </div>
            <hr class="section-divider">
        </div>
        <?php if (count($article->getImages()) > 1) : ?>
            <figure class="wp-block-gallery wp-block-image columns-3 entry-bottom mt-30 mb-30 wow fadeIn animated nowrap d-block">
                <ul class="blocks-gallery-grid carousel">
                    <?php foreach ($article->getImages() as $image) : ?>
                        <li class="blocks-gallery-item">
                            <a href="<?= $image->getUrl('1280x720') ?>" class="image-gallery-item">
                                <?= Html::img($image->getUrl('480x480'), [
                                    'alt' => $image->alt,
                                    'title' => $image->title,
                                    'class' => 'border-radius-5'
                                ]) ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </figure>
        <?php endif; ?>
        <div class="entry-bottom mt-30 mb-30 wow fadeIn animated">
            <div class="tags">
                <?php foreach (ArticleHelper::getArticleTags($article->tags) as $tag) : ?>
                    <a href="/?SearchArticle[searchString]=<?= $tag ?>" rel="tag">#<?= $tag ?></a>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="single-social-share clearfix wow fadeIn animated">
            <div class="entry-meta meta-1 font-small color-grey float-md-left mt-10">
                <span class="hit-count mr-15"><i class="elegant-icon icon_comment_alt mr-5"></i>
                    <?= ArticleHelper::getCommentsCountById($article->id) ?></span>
                <span class="hit-count mr-15"><i class="elegant-icon icon_heart_alt mr-5"></i>
                    <?= ArticleHelper::likeCount($article->id) ?>
                </span>
                <span class="hit-count"><i class="elegant-icon icon_profile mr-5"></i>
                    <?= ArticleHelper::getViewedCount($article->id) ?>
                </span>
            </div>

            <?= \ymaker\social\share\widgets\SocialShare::widget([
                'configurator' => 'socialShare',
                'url' => Url::to($article->alias, true),
                'title' => $article->meta_title,
                'description' => $article->meta_description,
                'imageUrl' => Url::to($article->getThumbFileUrl('image', 'blog_full'), true),
                'containerOptions' => ['tag' => 'ul', 'class' => 'header-social-network d-inline-block list-inline float-md-right mt-md-0 mt-4'],
                'linkContainerOptions' => ['tag' => 'li', 'class' => 'list-inline-item']
            ]); ?>
        </div>
        <!--related posts-->
        <?= \frontend\widgets\LatestArticles::widget() ?>

        <?= \frontend\widgets\FavoriteArticles::widget() ?>

        <!--Comments-->
        <div class="comments-area">
            <div class="widget-header-2 position-relative mb-30">
                <h5 class="mt-5 mb-30">Коментарі</h5>
            </div>
            <?php Pjax::begin(['id' => 'commentList']) ?>
            <?php if ($comments->getModels()) : ?>
                <?php foreach ($comments->getModels() as $comment) : ?>
                    <div class="comment-list wow fadeIn animated">
                        <div class="single-comment justify-content-between d-flex">
                            <div class="user justify-content-between d-flex">
                                <div class="thumb">
                                    <span class="bg-primary text-white">
                                        <?= ArticleHelper::getFirstSymbolByName($comment->name) ?>
                                        <?php if ($comment->author_like) : ?>
                                            <i class="elegant-icon icon_heart text-danger"></i>
                                        <?php endif; ?>
                                    </span>
                                </div>
                                <div class="desc">
                                    <p class="comment"><?= Html::encode($comment->text) ?></p>
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <h5>
                                                <i class="elegant-icon icon_profile"></i>
                                                <?= Html::encode($comment->name) ?>
                                            </h5>
                                            <p class="date"><i class="elegant-icon icon_calendar"></i>
                                                <?= Yii::$app->formatter->asRelativeTime($comment->created_at) ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php if ($comment->replys) : ?>
                            <?php foreach ($comment->replys as $reply) : ?>
                                <div class="single-comment depth-2 justify-content-between d-flex mt-20">
                                    <div class="user justify-content-between d-flex">
                                        <div class="thumb">
                                    <span class="bg-primary text-white">
                                        <img src="/backend/web/images/avatar.jpg" alt="">
                                    </span>
                                        </div>
                                        <div class="desc">
                                            <p class="comment"><?= Html::encode($reply->text) ?></p>
                                            <div class="d-flex justify-content-between">
                                                <div class="d-flex align-items-center">
                                                    <h5 class="text-danger">
                                                        <?= Html::encode($reply->name) ?>
                                                        <i class="text-muted small">(автор)</i>
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p class="text-muted text-center">Коментарі відсутні</p>
            <?php endif; ?>
            <?php Pjax::end() ?>
        </div>
        <!--comment form-->
        <div class="comment-form wow fadeIn animated">
            <div class="widget-header-2 position-relative mb-30">
                <h5 class="mt-5 mb-30">Залишити коментар</h5>
            </div>
            <?php $form = ActiveForm::begin([
                'action' => Url::to(['blog/add-comment', 'id' => $article->id]),
                'id' => 'commentForm',
                'options' => ['class' => 'form-contact comment_form'],
            ]) ?>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <?= $form->field($commentsModel, 'name')
                            ->textInput(['placeholder' => 'Ім`я'])
                            ->label(false) ?>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <?= $form->field($commentsModel, 'text')
                            ->textarea(['cols' => 30, 'rows' => 9, 'placeholder' => 'Коментар'])
                            ->label(false) ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn button button-contactForm">Відправити</button>
            </div>
            <?php ActiveForm::end() ?>
        </div>
    </article>
</div>

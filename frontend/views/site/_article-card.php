<?php

use blog\helpers\ArticleHelper;
use yii\helpers\StringHelper;

?>
<article class="col-md-4 mb-40 wow fadeInUp  animated" id="<?= $model->id ?>">
    <div class="post-card-1 border-radius-10 hover-up">
        <div class="post-thumb thumb-overlay img-hover-slide position-relative"
             style="background-image: url(<?= $model->image ? $model->getThumbFileUrl('image', 'blog_thumb') : '/images/no_image.jpg' ?>)">
            <a class="img-link" href="<?= $model->alias ?>"></a>
            <span class="top-right-icon bg-warning mr-40 btn-favorite">
                <i class="elegant-icon <?= ArticleHelper::inFavorite($model->id) ? 'icon_star' : 'icon_star_alt' ?>"></i>
            </span>
            <span class="top-right-icon bg-info btn-like">
                <i class="elegant-icon icon_heart_alt"></i>
            </span>
            <ul class="social-share">
                <li><a href="../demo.html#"><i
                            class="elegant-icon social_share"></i></a></li>
                <li><a class="fb" href="../demo.html#" title="Share on Facebook"
                       target="_blank"><i class="elegant-icon social_facebook"></i></a>
                </li>
                <li><a class="tw" href="../demo.html#" target="_blank"
                       title="Tweet now"><i class="elegant-icon social_twitter"></i></a>
                </li>
                <li><a class="pt" href="../demo.html#" target="_blank" title="Pin it"><i
                            class="elegant-icon social_pinterest"></i></a></li>
            </ul>
        </div>
        <div class="post-content p-30">
            <div class="d-flex post-card-content">
                <h5 class="post-title mb-20 font-weight-900">
                    <a href="<?= $model->alias ?>">
                        <?= StringHelper::truncate($model->name, '40') ?>
                    </a>
                </h5>
                <div class="post-excerpt mb-25 font-small text-muted">
                    <p><?= StringHelper::truncate($model->short_text, '120') ?></p>
                </div>
                <div class="entry-meta meta-1 float-left font-x-small text-uppercase">
                                            <span class="post-on"><i class="elegant-icon icon_calendar"></i>
                                                <?= Yii::$app->formatter->asDate($model->created_at, 'long') ?>
                                            </span>
                    <span class="time-reading has-dot"><i class="elegant-icon icon_comment"></i>
                                                <?= ArticleHelper::getCommentsCount($model->id) ?>
                                            </span>
                    <span class="post-by has-dot"><i class="elegant-icon icon_like"></i>
                                                23k
                                            </span>
                </div>
            </div>
        </div>
    </div>
</article>

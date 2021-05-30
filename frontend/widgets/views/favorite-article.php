<?php

/* @var $dataProvider Article */

use backend\models\Article;
use yii\widgets\Pjax;

?>
    <!--More posts-->
<?php Pjax::begin(['id' => 'favoriteArticle']) ?>
    <div class="single-more-articles border-radius-5">
        <div class="widget-header-2 position-relative mb-30">
            <h5 class="mt-5 mb-30">Обрані вами статті</h5>
            <button class="single-more-articles-close"><i class="elegant-icon icon_close"></i></button>
        </div>
        <div class="post-block-list post-module-1 post-module-5">
            <ul class="list-post">
                <?php foreach ($dataProvider->getModels() as $article) : ?>
                    <li class="mb-30">
                        <div class="d-flex hover-up-2 transition-normal">
                            <div class="post-thumb post-thumb-80 d-flex mr-15 border-radius-5 img-hover-scale overflow-hidden">
                                <a class="color-white" href="<?= $article->alias ?>">
                                    <img src="<?= $article->getThumbFileUrl('image', 'blog_thumb') ?>" alt="">
                                </a>
                            </div>
                            <div class="post-content media-body">
                                <h6 class="post-title mb-15 text-limit-2-row font-medium">
                                    <a href="<?= $article->alias ?>"><?= $article->name ?></a>
                                </h6>
                                <div class="entry-meta meta-1 float-left font-x-small text-uppercase">
                                <span class="post-on"><i class="elegant-icon icon_calendar"></i>
                                    <?= Yii::$app->formatter->asDate($article->created_at, 'short') ?></span>
                                    <span class="post-by has-dot">13k views</span>
                                </div>
                            </div>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
<?php Pjax::end() ?>
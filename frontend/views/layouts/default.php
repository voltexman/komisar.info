<?php

/* @var $this View */

/* @var $content string */

use blog\helpers\ArticleHelper;
use yii\helpers\Html;
use frontend\assets\AppAsset;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\Pjax;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html class="no-js" lang="<?= Yii::$app->language ?>">

    <head>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-Y23E0W5DPZ"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }

            gtag('js', new Date());

            gtag('config', 'G-Y23E0W5DPZ');
        </script>

        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php $this->head() ?>
    </head>

    <body>
    <?php $this->beginBody() ?>
    <div class="scroll-progress primary-bg"></div>
    <!-- Start Preloader -->
    <div class="preloader text-center">
        <div class="circle"></div>
    </div>
    <aside id="sidebar-wrapper" class="custom-scrollbar offcanvas-sidebar">
        <button class="off-canvas-close"><i class="elegant-icon icon_close"></i></button>
        <div class="sidebar-inner">
            <!--Categories-->
            <div class="sidebar-widget widget_categories mb-50 mt-30">
                <div class="widget-header-2 position-relative">
                    <h5 class="mt-5 mb-15">Hot topics</h5>
                </div>
                <div class="widget_nav_menu">
                    <ul>
                        <li class="cat-item cat-item-2"><a href="category.html">Travel tips</a> <span
                                    class="post-count">30</span></li>
                        <li class="cat-item cat-item-3"><a href="category-grid.html">Book review</a> <span
                                    class="post-count">25</span></li>
                        <li class="cat-item cat-item-4"><a href="category-list.html">Hotel review</a> <span
                                    class="post-count">16</span></li>
                        <li class="cat-item cat-item-5"><a href="category-masonry.html">Destinations </a> <span
                                    class="post-count">22</span></li>
                        <li class="cat-item cat-item-6"><a href="category-big.html">Lifestyle</a> <span
                                    class="post-count">25</span></li>
                    </ul>
                </div>
            </div>
            <!--Latest-->
            <div class="sidebar-widget widget-latest-posts mb-50">
                <div class="widget-header-2 position-relative mb-30">
                    <h5 class="mt-5 mb-30">Don't miss</h5>
                </div>
                <div class="post-block-list post-module-1 post-module-5">
                    <ul class="list-post">
                        <li class="mb-30">
                            <div class="d-flex hover-up-2 transition-normal">
                                <div class="post-thumb post-thumb-80 d-flex mr-15 border-radius-5 img-hover-scale overflow-hidden">
                                    <a class="color-white" href="single.html">
                                        <img src="imgs/news/thumb-1.jpg" alt="">
                                    </a>
                                </div>
                                <div class="post-content media-body">
                                    <h6 class="post-title mb-15 text-limit-2-row font-medium"><a href="single.html">The
                                            Life of a Travel Writer with David Farley</a></h6>
                                    <div class="entry-meta meta-1 float-left font-x-small text-uppercase">
                                        <span class="post-on">05 August</span>
                                        <span class="post-by has-dot">300 views</span>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="mb-30">
                            <div class="d-flex hover-up-2 transition-normal">
                                <div class="post-thumb post-thumb-80 d-flex mr-15 border-radius-5 img-hover-scale overflow-hidden">
                                    <a class="color-white" href="single.html">
                                        <img src="imgs/news/thumb-2.jpg" alt="">
                                    </a>
                                </div>
                                <div class="post-content media-body">
                                    <h6 class="post-title mb-15 text-limit-2-row font-medium"><a href="single.html">Why
                                            Don’t More Black American Women Travel Solo?</a></h6>
                                    <div class="entry-meta meta-1 float-left font-x-small text-uppercase">
                                        <span class="post-on">12 August</span>
                                        <span class="post-by has-dot">23k views</span>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="mb-30">
                            <div class="d-flex hover-up-2 transition-normal">
                                <div class="post-thumb post-thumb-80 d-flex mr-15 border-radius-5 img-hover-scale overflow-hidden">
                                    <a class="color-white" href="single.html">
                                        <img src="imgs/news/thumb-3.jpg" alt="">
                                    </a>
                                </div>
                                <div class="post-content media-body">
                                    <h6 class="post-title mb-15 text-limit-2-row font-medium"><a href="single.html">The
                                            22 Best Things to See and Do in Bangkok</a></h6>
                                    <div class="entry-meta meta-1 float-left font-x-small text-uppercase">
                                        <span class="post-on">27 August</span>
                                        <span class="post-by has-dot">23k views</span>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </aside>
    <!-- Start Header -->
    <header class="main-header header-style-1 font-heading">
        <div class="header-top header-sticky">
            <div class="container">
                <div class="row pt-20 pb-20">
                    <div class="col-md-3 col-xs-6">
                        <a href="<?= Url::home() ?>"><img class="logo" src="imgs/theme/logo.png" alt=""></a>
                    </div>
                    <div class="col-md-9 col-xs-6 text-right header-top-right ">
                        <button class="search-icon d-md-inline">
                        <span class="text-muted font-small">
                            <i class="elegant-icon icon_search mr-5"></i>Пошук</span>
                        </button>
                        <span class="vertical-divider mr-20 ml-20 d-md-inline"></span>
                        <?php Pjax::begin(['id' => 'favoriteMenu', 'timeout' => false]) ?>
                        <a href="<?= Url::to(['site/favorite']) ?>" data-pjax="0">
                        <span class="mr-20 <?= Yii::$app->controller->action->id === 'favorite' ? 'text-primary' : null ?>">
                            <i class="elegant-icon <?= ArticleHelper::hasFavorite() ? 'icon_star' : 'icon_star_alt' ?>"></i>
                            <?php if (ArticleHelper::favoriteCount()) : ?>
                                <small class="text-muted dot-pulse position-relative"><?= ArticleHelper::favoriteCount() ?></small>
                            <?php endif; ?>
                        </span>
                        </a>
                        <?php Pjax::end() ?>
                        <a href="<?= Url::to(['site/contact']) ?>">
                            <span class="<?= Yii::$app->controller->action->id === 'contact' ? 'text-primary' : null ?>">
                                <i class="elegant-icon <?= Yii::$app->controller->action->id === 'contact' ? 'icon_mail' : 'icon_mail_alt' ?>"></i>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!--Start search form-->
    <?= \frontend\widgets\SearchWidget::widget() ?>

    <!-- Start Main content -->
    <main>
        <?= $content ?>
    </main>
    <!-- End Main content -->

    <footer class="pt-50 pb-20 bg-grey">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="sidebar-widget wow fadeInUp animated mb-30">
                        <div class="widget-header-2 position-relative mb-30">
                            <h5 class="mt-5 mb-30">Про мене</h5>
                        </div>
                        <div class="textwidget">
                            <p>
                                Start writing, no matter what. The water does not flow until the faucet is turned on.
                            </p>
                            <p>
                                Start writing, no matter what. The water does not flow until the faucet is turned on.
                            </p>
                            <p><strong class="color-black">Я в соц. мережах</strong><br>
                            <ul class="header-social-network d-inline-block list-inline color-white mb-20">
                                <li class="list-inline-item"><a class="fb" href="single.html#" target="_blank"
                                                                title="Facebook"><i
                                                class="elegant-icon social_facebook"></i></a></li>
                                <li class="list-inline-item"><a class="tw" href="single.html#" target="_blank"
                                                                title="Tweet now"><i
                                                class="elegant-icon social_twitter"></i></a></li>
                                <li class="list-inline-item"><a class="pt" href="single.html#" target="_blank"
                                                                title="Pin it"><i
                                                class="elegant-icon social_pinterest"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="sidebar-widget widget_tagcloud wow fadeInUp animated mb-30" data-wow-delay="0.2s">
                        <div class="widget-header-2 position-relative mb-30">
                            <h5 class="mt-5 mb-30">Актуальні теги</h5>
                        </div>
                        <div class="tagcloud mt-50">
                            <?php foreach (ArticleHelper::getActualTags(10) as $tag) : ?>
                                <a class="tag-cloud-link"
                                   href="/?SearchArticle[searchString]=<?= $tag ?>">#<?= $tag ?></a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="sidebar-widget widget_newsletter wow fadeInUp animated mb-30" data-wow-delay="0.3s">
                        <div class="widget-header-2 position-relative mb-30">
                            <h5 class="mt-5 mb-30">Пропозиція</h5>
                        </div>
                        <div class="newsletter">
                            <p class="font-medium">Ви можете запропонувати будь-яку тему для написання статті, яка вас
                                зацікавила.</p>
                            <p class="font-medium">Також ви можете подати свою нову ідею по покращеню мого сайту чи
                                функціоналу.</p>
                            <form class="input-group form-subcriber mt-30 d-flex">
                                <input type="email" class="form-control bg-white font-small"
                                       placeholder="Тема або ідея">
                                <button class="btn bg-primary text-white" type="submit">Подати</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-copy-right pt-30 mt-20 wow fadeInUp animated">
                <p class="float-md-left font-small text-muted">© <?= Yii::$app->formatter->asDate('now', 'Y') ?>, Блог -
                    Максим Комісар </p>
                <p class="float-md-right font-small text-muted"><?= Yii::$app->name ?> | Всі права захищені</p>
            </div>
        </div>
    </footer>

    <div class="dark-mark"></div>
    <?php $this->endBody() ?>
    </body>

    </html>
<?php $this->endPage() ?>
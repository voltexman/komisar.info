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
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php $this->head() ?>
    </head>

    <body data-statistics-id="<?= Yii::$app->session->getFlash('statisticsId') ?>"
          data-real-id="<?= Yii::$app->session->getFlash('realId') ?>">
    <?php $this->beginBody() ?>
    <div class="scroll-progress primary-bg"></div>
    <!-- Start Preloader -->
    <div class="preloader text-center">
        <div class="circle"></div>
    </div>

    <aside id="sidebar-wrapper" class="custom-scrollbar offcanvas-sidebar">
        <button class="off-canvas-close"><i class="elegant-icon icon_close"></i></button>
        <div class="sidebar-inner"></div>
    </aside>

    <!-- Start Header -->
    <header class="main-header header-style-1 font-heading">
        <div class="header-top header-sticky">
            <div class="container">
                <div class="row pt-20 pb-20">
                    <div class="col-md-3 col-xs-6">
                        <a href="<?= Url::home() ?>"><img class="logo" src="/imgs/theme/logo.png" alt=""></a>
                    </div>
                    <div class="col-md-9 col-xs-6 text-right header-top-right p-0 pr-20">
                        <button class="search-icon d-md-inline">
                        <span class="text-muted font-medium">
                            <i class="elegant-icon icon_search mr-5 font-large"></i>Пошук</span>
                        </button>
                        <span class="vertical-divider mr-20 ml-20 d-md-inline"></span>
                        <?php Pjax::begin(['id' => 'favoriteMenu', 'timeout' => false]) ?>
                        <a rel="nofollow" href="<?= Url::to(['site/favorite']) ?>" data-pjax="0" class="font-large">
                        <span class="mr-20 <?= Yii::$app->controller->action->id === 'favorite' ? 'text-primary' : null ?>">
                            <i class="elegant-icon <?= ArticleHelper::hasFavorite() ? 'icon_star' : 'icon_star_alt' ?>"></i>
                            <?php if (ArticleHelper::favoriteCount()) : ?>
                                <small class="text-muted dot-pulse position-relative"><?= ArticleHelper::favoriteCount() ?></small>
                            <?php endif; ?>
                        </span>
                        </a>
                        <?php Pjax::end() ?>
                        <a href="<?= Url::to(['site/contact']) ?>" class="font-large">
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
                <div class="col-lg-4 col-md-6 offset-md-2">
                    <div class="sidebar-widget widget_tagcloud wow fadeInUp animated mb-30" data-wow-delay="0.2s">
                        <div class="widget-header-2 position-relative mb-30">
                            <h5 class="mt-5 mb-30">Актуальні теги</h5>
                        </div>
                        <div class="tagcloud mt-50">
                            <?php foreach (ArticleHelper::getActualTags(10) as $tag) : ?>
                                <a class="tag-cloud-link" rel="nofollow"
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
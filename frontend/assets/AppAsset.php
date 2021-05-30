<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/style.css',
        'css/widgets.css',
        'css/responsive.css',
        'css/toastr.css',
        'css/magnific-popup.css'
//        'css/owl.css'
    ];
    public $js = [
        'js/vendor/modernizr-3.5.0.min.js',
        'js/vendor/timeme.min.js',
//        'js/vendor/jquery-1.12.4.min.js',
        'js/vendor/popper.min.js',
        'js/vendor/bootstrap.min.js',
        'js/vendor/jquery.slicknav.js',
        'js/vendor/slick.min.js',
        'js/vendor/wow.min.js',
        'js/vendor/jquery.ticker.js',
        'js/vendor/jquery.vticker-min.js',
        'js/vendor/jquery.scrollUp.min.js',
        'js/vendor/jquery.nice-select.min.js',
        'js/vendor/jquery.magnific-popup.js',
        'js/vendor/jquery.sticky.js',
        'js/vendor/perfect-scrollbar.js',
        'js/vendor/waypoints.min.js',
        'js/vendor/jquery.theia.sticky.js',
        'js/toastr.min.js',
        'js/main.js',
        'js/custom.js',
//        'js/owl.js',
//        'js/slick.js',
//        'js/isotope.js',
//        'js/accordions.js'
    ];

    public $depends = [
        'yii\web\JqueryAsset',
        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
    ];
}

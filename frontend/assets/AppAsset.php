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
        'css/jquery.bxslider.css',
        'css/animate.css',
        'css/slider/owl.carousel.css',
        'css/slider/owl.theme.default.min.css',

    ];
    public $js = [
        'js/jquery.min.js',
        'js/waypoints.min.js',
        'js/jquery.counterup.min.js',
        'js/jquery.parallax-1.1.3.js',
        'js/jquery.localscroll-1.2.7-min.js',
        'js/wow.min.js',
        'js/owl.carousel.js',
        'js/element.js',
        'js/jquery.bxslider.min.js',
    ];
    public $depends = [
    ];
}

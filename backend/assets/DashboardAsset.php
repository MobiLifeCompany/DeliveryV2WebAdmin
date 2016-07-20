<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class DashboardAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/bootstrap.min.css',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css',
        'https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css',
        'css/AdminLTE.css',
        'css/skins/_all-skins.min.css',
        'css/plugins/iCheck/flat/blue.css',
        'css/plugins/morris/morris.css',
        'css/plugins/jvectormap/jquery-jvectormap-1.2.2.css',
        'css/plugins/datepicker/datepicker3.css',
        'css/plugins/daterangepicker/daterangepicker.css',
        'css/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css',
    ];
    public $js = [
        //'https://code.jquery.com/ui/1.11.4/jquery-ui.min.js',
        //'js/jQuery/jquery-2.2.3.min.js',
        'js/bootstrap/bootstrap.min.js',
        //'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js',
      //  'https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js',
        'js/morris/morris.min.js',
        'js/fastclick/fastclick.js',
        'js/app.min.js',
        'js/sparkline/jquery.sparkline.min.js',
        'js/jvectormap/jquery-jvectormap-1.2.2.min.js',
        'js/jvectormap/jquery-jvectormap-world-mill-en.js',
        'js/knob/jquery.knob.js',
        'js/chartjs/Chart.min.js',
        'js/daterangepicker/daterangepicker.js',
        'js/datepicker/bootstrap-datepicker.js',
        'js/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js',
        'js/slimScroll/jquery.slimscroll.min.js',
        
        
        'js/demo.js',
       // 'js/main.js',
        'js/pages/dashboard2.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}

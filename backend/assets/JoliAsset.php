<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class JoliAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/stil.css',
    ];
    public $js = [
        //'js/plugins/jquery/jquery.min.js',
        'js/plugins/jquery/jquery-ui.min.js',
        'js/plugins/bootstrap/bootstrap.min.js',
        'js/plugins/icheck/icheck.min.js',
        'js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js',
        'js/plugins/scrolltotop/scrolltopcontrol.js',
        'js/plugins/morris/raphael-min.js',
        'js/plugins/morris/morris.min.js',
        'js/plugins/rickshaw/d3.v3.js',
        'js/plugins/rickshaw/rickshaw.min.js',
        'js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js',
        'js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js',
        //'js/plugins/bootstrap/bootstrap-datepicker.js',
        'js/plugins/owl/owl.carousel.min.js',
        'js/plugins/moment.min.js',
        'js/plugins/daterangepicker/daterangepicker.js',
        'js/settings.js',
        'js/plugins.js',
        'js/actions.js',
        'js/demo_dashboard.js',
        'js/demo_tables.js',
        'js/plugins/blueimp/jquery.blueimp-gallery.min.js',
        'js/plugins/dropzone/dropzone.min.js',
        'js/plugins/noty/jquery.noty.js',
        'js/plugins/noty/layouts/topCenter.js',
        'js/plugins/noty/layouts/topLeft.js',
        'js/plugins/noty/layouts/topRight.js',
        'js/plugins/summernote/summernote.js',
        'js/plugins/tagsinput/jquery.tagsinput.min.js',
        'js/plugins/bootstrap/bootstrap-select.js',
        'js/plugins/noty/themes/default.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}

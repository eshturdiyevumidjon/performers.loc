<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class ItakeAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
      'font/stylesheet.css',
      'font/roboto.css',
      'css/all.min.css',
      'css/jquery.fancybox.min.css',
      'css/bootstrap.min.css',
      'font/stylesheet_segoe.css',
      'css/swiper.min.css',
      'css/style.css',
      'css/media.css',
      'css/mycss.css',
      'css/dd.css',
      'css/chat.css',
    ];
    public $js = [
      // 'js/jquery.min.js',
      'js/swiper.min.js',
      'js/popper.min.js',
      'js/bootstrap.min.js',
      'js/jquery.maskedinput.js',
      'js/jquery.fancybox.min.js',
      'js/all.min.js',
      // 'js/select.js',
      '/js/dd.js',
      '/js/chat.js',
      'js/main.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        // 'yii\bootstrap\BootstrapAsset',
        // 'yii\bootstrap\BootstrapPluginAsset',
    ];
}

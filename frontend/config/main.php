<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'name'=>'iTake',
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'i18n' => [
            'translations' => [
                'app*' => [
                    'basePath' => '@common/messages',
                    'class' => 'yii\i18n\PhpMessageSource',
                    'sourceLanguage' => 'en',
                    'fileMap' => [
                        'app'=>'app.php',
                        'app/error'=>'app/error.php',
                    ],
                ],
            ],
        ],
        'assetManager'=>[
            'bundles'=>[
                'yii\web\JqueryAsset'=>[
                    'js'=>[]
                ],
                'yii\bootstrap\BootstrapPluginAsset'=>[
                    'js'=>[]
                ],
                'yii\bootstrap\BootstrapAsset'=>[
                    'css'=>[],
                ],
            ],
        ],
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
         'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'class' => 'codemix\localeurls\UrlManager',
            'languages' => ['af','en', 'ar', 'az', 'be', 'bg', 'bs', 'cs', 'da', 'de', 'el', 'es', 'et', 'fa', 'fi', 'fr', 'he', 'hr', 'hu', 'hy', 'id', 'it', 'ja', 'ka', 'kk', 'ko', 'kz',  'lv', 'ms', 'nb-NO', 'nl', 'pl', 'pt', 'pt-BR', 'ro', 'ru', 'sk', 'sl', 'sr', 'sr-Latn', 'sv', 'tg', 'th', 'tr', 'uk', 'uz', 'vi', 'zh-CN', 'zh-TW'],
            'on languageChanged' => '\common\models\PreferenceBooks::onLanguageChanged',
        ],
    ],
    'params' => $params,
];

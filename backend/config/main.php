<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'name'=>'Itake',
    'timeZone' => 'Asia/Tashkent',
    'defaultRoute' =>'/site/dashboard',
    'modules' => [
    'gridview' =>  [
        'class' => '\kartik\grid\Module'
        ]       
    ],
    'language'=>'ru-RU',
    
    'components' => [
        // 'yandexMapsApi' => [
        //         'class' => 'mirocow\yandexmaps\Api',
        //     ],
         'assetManager' => [
                'bundles' => [
                    'kartik\form\ActiveFormAsset' => [
                        'bsDependencyEnabled' => false // do not load bootstrap assets for a specific asset bundle
                    ],
                ],
            ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => true,
        ],
        
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'sourceLanguage' => 'en',
                    'fileMap' => [
                        'app'=>'app.php',
                        'app/error'=>'app/error.php',
                    ],
                ],
            ],
        ],
        
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie'
             => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
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

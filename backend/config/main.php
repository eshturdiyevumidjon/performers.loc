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
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@backend/views/mail',
            'useFileTransport' => true,
        ],
        'i18n' => [
        'translations' => [
            '*' => [
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => '@backend/messages',
                'sourceLanguage' => 'en',
                'fileMap' => [
                    //'main' => 'main.php',
                ],
            ],
        ],
    ],
        'assetManager'=>[
            'bundles'=>[
                // 'yii\web\JqueryAsset'=>[
                //     'js'=>[]
                // ],
                // 'yii\bootstrap\BootstrapPluginAsset'=>[
                //     'js'=>[]
                // ],
                // 'yii\bootstrap\BootstrapAsset'=>[
                //     'css'=>[],
                // ],
            ],
        ],
        'request' => [
            'class' => 'backend\components\LangRequest',
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
            'class'=>'backend\components\LangUrlManager',
               'rules'=>[
                    '/' => 'site/index',
                    '<controller:\w+>/<action:\w+>/*'=>'<controller>/<action>',
                ],
        ],
        'as BeforeRequest'=>[
            'class'=>'backend\components\LanguageHandler',
        ],
    ],
    'params' => $params,
];

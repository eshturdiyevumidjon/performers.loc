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
    'name'=>'iTake',
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
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com',
                'username' => 'itake1110@gmail.com',
                'password' => '123456itake',
                'port' => '465',
                'encryption' => 'ssl',
                'streamOptions' => [ 
                    'ssl' => [ 
                        'allow_self_signed' => true,
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                    ],
                ]
            ],
        ],
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

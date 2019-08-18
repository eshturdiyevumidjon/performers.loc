<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'i18n' => [
            'translations' => [
// * - все категории
                '*' => [
                    'class' => 'yii\i18n\DbMessageSource',
                    'sourceMessageTable'=>'{{%source_message}}',
                    'messageTable'=>'{{%message}}',
                    'sourceLanguage' => 'ru',
                    'forceTranslation' => true,
                    'on missingTranslation' => ['common\components\TranslationEventHandler', 'handleMissingTranslation']
                ],
            ],
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
];

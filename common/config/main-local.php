<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=host1766503_itake',
            'username' => 'host1766503_umid',
            'password' => 'ngbDEiyD',
            'charset' => 'utf8',
        ],
        // 'mailer' => [
        //     'class' => 'yii\swiftmailer\Mailer',
        //     'viewPath' => '@common/mail',
        //     // send all mails to a file by default. You have to set
        //     // 'useFileTransport' to false and configure a transport
        //     // for the mailer to send real emails.
        //     'useFileTransport' => true,
        // ],
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
            ],
        ],
    ],
];
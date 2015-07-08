<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
      'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
              'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => '74.125.206.109',  // e.g. smtp.mandrillapp.com or smtp.gmail.com
                'username' => 'david.paul.inc@gmail.com',
                'password' => 'Dp09556924',
                'port' => '587', // Port 25 is a very common port too
                'encryption' => 'tls', // It is often used, check your provider or mail server
               ],
        ],
	'urlManager' => [
    		'enablePrettyUrl' => true,
    		'rules' => [ ],
        // your rules go here
    	],
    ],
];

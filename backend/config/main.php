<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
        'modules' => [
        'gridview' =>  [
            'class' => '\kartik\grid\Module'
            // enter optional module parameters below - only if you need to  
            // use your own export download action or custom translation 
            // message source
            // 'downloadAction' => 'gridview/export/download',
            // 'i18n' => []
        ],
        'gii' => [
            'class' => 'yii\gii\Module',
            'allowedIPs' => ['127.0.0.1', '::1', '192.168.1.*','50.117.45.141', 'XXX.XXX.XXX.XXX'] // adjust this to your needs
        ]
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
            'timeout' => 86400,
        ],
        'i18n' => [
            'translations' => [
                'app' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'forceTranslation' => true,
                    //'basePath' => '@app/messages',
                    'sourceLanguage' => 'en',
                    'fileMap' => [
                        'app' => 'app.php',
                        'app/error' => 'error.php',
                    ],
                ],
            ],
        ],
        'assetManager' => [
        'bundles' => [
            'dosamigos\google\maps\MapAsset' => [
                'options' => [
                    'key' => 'AIzaSyAxTCrolhKmaAVD2l2JAWNRhPPoRxOY5jY',
                    'language' => 'en',
                    'version' => '3.1.18'
                ]
              ]
            ]
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
        'authManager' => [
                           'class' => 'yii\rbac\DbManager',
                           'defaultRoles' => ['guest'],
          ],
        'mailer' => [
              'class' => 'yii\swiftmailer\Mailer',
               'useFileTransport' => false,
               // 'transport' => [
             //   'class' => 'Swift_SmtpTransport',
             //   'host' => 'smtp.gmail.com',  
             //   'username' => 'mobilifecomp@gmail.com',
             //   'password' => 'Mobilife',
             //   'port' => '465', 
           //     'encryption' => 'tls', 
           // ],
          ],
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
    'as beforeRequest' => [
        'class' =>'backend\components\CheckIfLoggedIn'
    ],
    'params' => $params,
];

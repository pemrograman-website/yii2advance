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
   'modules' => [
      'user' => [
         // following line will restrict access to admin controller from frontend application
         'as frontend' => 'dektrium\user\filters\FrontendFilter',
      ],
   ],
   'components' => [
      'request' => [
            'csrfParam' => '_csrf-backend',
      ],
      /* Advanced Template
         Disabled because of dektrium/yii2-user
      
      'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
      ],
      'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
      ],*/

      // Add for dektrium/yii2-user
      'user' => [
         'identityCookie' => [
            'name'     => '_backendIdentity',
            'path'     => '/admin',
            'httpOnly' => true,
         ],
      ],
      'session' => [
            'name' => 'BACKENDSESSID',
            'cookieParams' => [
               'httpOnly' => true,
               'path'     => '/admin',
            ],
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
      /*
      'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
      ],
      */
   ],
   'params' => $params,
];

<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'name'=>'Yii2 WebApplication Basic For You', // Change name "My Yii Application"  (แก้ไข title มีผลกับทุก page)
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'timeZone' => 'Asia/Bangkok', // เพิ่มเติม timeZone
    'language'=>'th_TH',// เพิ่มเติม ให้แสดงภาษาไทย
    'modules' => [
      'user' => [
          'class' => 'dektrium\user\Module',
          'enableUnconfirmedLogin' => true,
          'enableConfirmation' => false,
          'cost' => 12,
          'confirmWithin' => 21600,
          'cost' => 12,
          'admins' => ['admin']
      ],
      'admin' => [
        'class' => 'mdm\admin\Module',
        'layout' => 'top-menu',  // left-menu ,top-menu กำหนดตำแหน่งของเมนู
        'menus' => [
            'assignment' => [
                'label' => 'ให้สิทธิ์' // change label
            ]
        ],
        'controllerMap' => [
             'assignment' => [
                'class' => 'mdm\admin\controllers\AssignmentController',
                'userClassName' => 'dektrium\user\models\User',
                //เรียกใช้โมเดล user ของ dektrium
            ]
        ],
      ],
      'report' => [
                'class' => 'frontend\modules\report\Module',
      ],
  ],

    'components' => [
        'user' => [
          //'identityClass' => 'app\models\User',  // ระบบทีมากับ yii2
            'identityClass' => 'dektrium\user\models\User',
            'enableAutoLogin' => true,
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
         'class' => 'yii\web\urlManager',
         'enablePrettyUrl' => true,
         'showScriptName' => false,
         'rules' => [
                    '<controller:\w+>/<id:\d+>' => '<controller>/view',
                    '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                    '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                    ['class' => 'yii\rest\UrlRule', 'controller' => 'location', 'except' => ['delete','GET', 'HEAD','POST','OPTIONS'], 'pluralize'=>false],
                    '<module:\w+>/<controller:\w+>/<action:\w+>' => '<module>/<controller>/<action>',
          ],
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
    // หลังจาก config เรียบร้อยแล้วให้ปิด access site,admin
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            'site/*',
            //'admin/*',
            'some-controller/some-action',
        ]
    ],
    'params' => $params,
];

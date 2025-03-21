<?php

namespace api\modules\v1;

use yii\filters\AccessControl;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\Cors;

/**
 * v1 module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'api\modules\v1\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['authenticator'] = [
            'class' => CompositeAuth::class,
            'authMethods' => [
//                HttpBasicAuth::class,
//                QueryParamAuth::class,
                HttpBearerAuth::class,
            ],
        ];

        $behaviors['access'] = [
            'class' => AccessControl::class,
            'rules' => [
                [
                    'allow' => true,
                    'actions' => ['index', 'view', 'create', 'update', 'delete', 'clear-cache'],
                    'roles' => ['@'],
                ]
            ],
        ];

        $behaviors['corsFilter'] = [
            'class' => Cors::class,
            'cors' => [
                'Origin' => static::allowedDomains(),
                'Access-Control-Request-Method' => ['GET', 'HEAD', 'POST', 'PUT', 'PATCH', 'OPTIONS', 'DELETE'],
                'Access-Control-Max-Age' => 3600,
                'Access-Control-Request-Headers' => ['*'],
                'Access-Control-Expose-Headers' => ['*'],
                'Access-Control-Allow-Credentials' => false,
                'Access-Control-Allow-Methods' => ['GET', 'HEAD', 'POST', 'PUT', 'PATCH', 'OPTIONS', 'DELETE'],
                'Access-Control-Allow-Headers' => ['Authorization', 'X-Requested-With', 'content-type'],
//                'Access-Control-Allow-Origin' => ['*'],
            ],
        ];

        return $behaviors;
    }

    /**
     * @var array
     */
    public static $urlRules = [
        [
            'class' => 'yii\rest\UrlRule',
            'controller' => 'v1',
            'pluralize' => false,
            'patterns' => [
                'GET' => 'default/index',
                'GET clear-cache' => 'default/clear-cache',
            ]
        ],
        [
            'class' => 'yii\rest\UrlRule',
            'controller' => 'v1/user',
            'pluralize' => false,
            'patterns' => [
                'OPTIONS <action>' => 'options',

                'GET' => 'index',
                'GET index' => 'index',
            ]
        ],
        [
            'class' => 'yii\rest\UrlRule',
            'controller' => 'v1/file',
            'pluralize' => false,
            'patterns' => [
                'OPTIONS <action>' => 'options',

                'GET' => 'index',
                'GET index' => 'index',
            ]
        ],
        [
            'class' => 'yii\rest\UrlRule',
            'controller' => 'v1/menu',
            'pluralize' => false,
            'patterns' => [
                'OPTIONS <action>' => 'options',

                'GET' => 'index',
                'GET <id:\d+>' => 'view',

                'POST create' => 'create',
                'PUT <id:\d+>/update' => 'update',
                'DELETE <id:\d+>/delete' => 'delete',
            ]
        ],
        [
            'class' => 'yii\rest\UrlRule',
            'controller' => 'v1/menu-items',
            'pluralize' => false,
            'patterns' => [
                'OPTIONS <action>' => 'options',

                'GET' => 'index',
                'GET <id:\d+>' => 'view',

                'POST create' => 'create',
                'POST <id:\d+>/update' => 'update',
                'DELETE <id:\d+>/delete' => 'delete',
            ]
        ],
        [
            'class' => 'yii\rest\UrlRule',
            'controller' => 'v1/banner',
            'pluralize' => false,
            'patterns' => [
                'OPTIONS <action>' => 'options',

                'GET' => 'index',
                'GET <id:\d+>' => 'view',

                'POST create' => 'create',
                'POST <id:\d+>/update' => 'update',
                'DELETE <id:\d+>/delete' => 'delete',
            ]
        ],
    ];

    /**
     * @return array
     */
    public static function allowedDomains()
    {
        return [
            '*',
        ];
    }
}

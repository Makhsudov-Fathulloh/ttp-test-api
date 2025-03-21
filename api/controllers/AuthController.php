<?php

namespace api\controllers;

use api\models\LoginForm;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\rest\Controller;
use yii\rest\OptionsAction;
use yii\web\Response;

/**
 * Site controller for API
 */
class AuthController extends Controller
{
    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ]);
    }

    /**
     * Error handling
     */
    public function actions()
    {
        return [
            'options' => [
                'class' => OptionsAction::class,
            ],
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
        ];
    }

    /**
     * API home
     */
    public function actionIndex()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        return ['message' => 'Welcome to test API'];
    }

    /**
     * Login action for API
     */
    public function actionLogin()
    {
        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post(), '') && ($token = $model->login())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['token' => $token];
        }

        return [
            'message' => 'Invalid create token',
            'errors' => $model->errors,
        ];
    }

    /**
     * Logout action for API
     */
    public function actionLogout()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        Yii::$app->user->logout();

        return ['status' => 'success', 'message' => 'Logged out successfully'];
    }
}

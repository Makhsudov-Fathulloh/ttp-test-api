<?php

namespace api\modules\v1\controllers;

use Yii;
use yii\rest\Controller;
use yii\web\Response;

/**
 * Default controller for the `v1` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string[]
     */
    public function actionIndex()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        return ['message' => 'Welcome to v1 test API'];
    }

    public function actionClearCache()
    {
        if (Yii::$app->cache->flush()) {
            return ['message' => 'success'];
        } else {
            return ['message' => 'error'];
        }
    }
}

<?php

namespace api\modules\v1\controllers;

use api\models\User;
use yii\data\ActiveDataProvider;

/**
 * User controller for the `v1` module
 */
class UserController extends ApiController
{
    public $data = 'users';

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
           'query' => User::find()
        ]);

        return $dataProvider;
    }
}

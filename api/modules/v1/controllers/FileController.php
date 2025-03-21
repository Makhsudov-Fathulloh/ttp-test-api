<?php

namespace api\modules\v1\controllers;

use api\models\File;
use yii\data\ActiveDataProvider;

/**
 * User controller for the `v1` module
 */
class FileController extends ApiController
{
    public $data = 'files';

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
           'query' => File::find()
        ]);

        return $dataProvider;
    }
}

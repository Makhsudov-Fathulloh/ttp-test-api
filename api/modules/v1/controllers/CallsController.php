<?php

namespace api\modules\v1\controllers;

use api\models\Calls;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

/**
 * User controller for the `v1` module
 */
class CallsController extends ApiController
{
    public $data = 'calls';

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Calls::find()
        ]);

        return $dataProvider;
    }

    public function actionView($id)
    {
        return $this->findModel($id);
    }

    public function actionCreate()
    {
        $model = new Calls();

        if ($this->request->isPost) {
            if ($model->load($this->request->post(), '') && $model->validate()) {
                $model->save();
                return [
                    'success' => 'Created "Calls" successfully',
                    'data' => $model,
                ];
            }
        }

        return [
            'success' => 'Error creating "Calls"',
            'errors' => $model->errors,
        ];
    }

    protected function findModel($id)
    {
        if (($model = Calls::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested calls.id does not exist.');
    }
}

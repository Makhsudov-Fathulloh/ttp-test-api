<?php

namespace api\modules\v1\controllers;

use api\models\Region;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

/**
 * User controller for the `v1` module
 */
class RegionController extends ApiController
{
    public $data = 'region';

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Region::find()
        ]);

        return $dataProvider;
    }

    public function actionView($id)
    {
        return $this->findModel($id);
    }

    public function actionCreate()
    {
        $model = new Region();

        if ($this->request->isPost) {
            if ($model->load($this->request->post(), '') && $model->validate()) {
                $model->save();
                return [
                    'success' => 'Created "Region" successfully',
                    'data' => $model,
                ];
            }
        }

        return [
            'success' => 'Error creating "Region"',
            'errors' => $model->errors,
        ];
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPut && $model->load($this->request->post(), '') && $model->validate()) {
            $model->save();

            return [
                'success' => 'Update "Region" successfully',
                'data' => $model,
            ];        }

        return [
            'success' => 'Error update "Region"',
            'errors' => $model->errors,
        ];
    }


    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->status = Region::STATUS_DELETED;
        $model->deleted_at = date('U');
        $model->save();

        return array(
            'status' => 1,
            'message' => 'successfully deleted'
        );
    }

    protected function findModel($id)
    {
        if (($model = Region::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested region.id does not exist.');
    }
}

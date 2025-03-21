<?php

namespace api\modules\v1\controllers;

use api\models\Setting;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

/**
 * User controller for the `v1` module
 */
class SettingController extends ApiController
{
    public $data = 'setting';

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Setting::find()
        ]);

        return $dataProvider;
    }

    public function actionView($id)
    {
        return $this->findModel($id);
    }

    public function actionCreate()
    {
        $model = new Setting();

        if ($this->request->isPost) {
            if ($model->load($this->request->post(), '') && $model->validate()) {
                $model->save();
                return [
                    'success' => 'Created "Setting" successfully',
                    'data' => $model,
                ];
            }
        }

        return [
            'success' => 'Error creating "Setting"',
            'errors' => $model->errors,
        ];
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPut && $model->load($this->request->post(), '') && $model->validate()) {
            $model->save();

            return [
                'success' => 'Update "Setting" successfully',
                'data' => $model,
            ];        }

        return [
            'success' => 'Error update "Setting"',
            'errors' => $model->errors,
        ];
    }


    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->status = Setting::STATUS_DELETED;
        $model->deleted_at = date('U');
        $model->save();

        return array(
            'status' => 1,
            'message' => 'successfully deleted'
        );
    }

    protected function findModel($id)
    {
        if (($model = Setting::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested setting.id does not exist.');
    }
}

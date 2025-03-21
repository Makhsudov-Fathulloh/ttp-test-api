<?php

namespace api\modules\v1\controllers;

use api\models\Widget;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

/**
 * User controller for the `v1` module
 */
class WidgetController extends ApiController
{
    public $data = 'widget';

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Widget::find()
        ]);

        return $dataProvider;
    }

    public function actionView($id)
    {
        return $this->findModel($id);
    }

    public function actionCreate()
    {
        $model = new Widget();

        if ($this->request->isPost) {
            if ($model->load($this->request->post(), '') && $model->validate()) {
                $model->save();
                return [
                    'success' => 'Created "Widget" successfully',
                    'data' => $model,
                ];
            }
        }

        return [
            'success' => 'Error creating "Widget"',
            'errors' => $model->errors,
        ];
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPut && $model->load($this->request->post(), '') && $model->validate()) {
            $model->save();

            return [
                'success' => 'Update "Widget" successfully',
                'data' => $model,
            ];        }

        return [
            'success' => 'Error update "Widget"',
            'errors' => $model->errors,
        ];
    }


    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->status = Widget::STATUS_DELETED;
        $model->deleted_at = date('U');
        $model->save();

        return array(
            'status' => 1,
            'message' => 'successfully deleted'
        );
    }

    protected function findModel($id)
    {
        if (($model = Widget::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested widget.id does not exist.');
    }
}

<?php

namespace api\modules\v1\controllers;

use api\models\Menu;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

/**
 * User controller for the `v1` module
 */
class MenuController extends ApiController
{
    public $data = 'menus';

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Menu::find()
        ]);

        return $dataProvider;
    }

    public function actionView($id)
    {
        return $this->findModel($id);
    }

    public function actionCreate()
    {
        $model = new Menu();

        if ($this->request->isPost) {
            if ($model->load($this->request->post(), '') && $model->validate()) {
                $model->save();
                return [
                    'success' => 'Created "Menu" successfully',
                    'data' => $model,
                ];
            }
        }

        return [
            'success' => 'Error creating "Menu"',
            'errors' => $model->errors,
        ];
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPut && $model->load($this->request->post(), '') && $model->validate()) {
            $model->save();

            return [
                'success' => 'Update "Menu" successfully',
                'data' => $model,
            ];        }

        return [
            'success' => 'Error update "Menu"',
            'errors' => $model->errors,
        ];
    }


    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->status = Menu::STATUS_DELETED;
        $model->deleted_at = date('U');
        $model->save();

        return array(
            'status' => 1,
            'message' => 'successfully deleted'
        );
    }

    protected function findModel($id)
    {
        if (($model = Menu::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested menu.id does not exist.');
    }
}

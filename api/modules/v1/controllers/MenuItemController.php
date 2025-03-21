<?php

namespace api\modules\v1\controllers;

use api\models\MenuItem;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

/**
 * User controller for the `v1` module
 */
class MenuItemController extends ApiController
{
    public $data = 'menuItems';

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => MenuItem::find()
        ]);

        return $dataProvider;
    }

    public function actionView($id)
    {
        return $this->findModel($id);
    }

    public function actionCreate()
    {
        $model = new MenuItem();

        if ($this->request->isPost) {
            if ($model->load($this->request->post(), '') && $model->validate()) {
                $model->document = UploadedFile::getInstanceByName('document');

                if ($model->uploadFile() && $model->save(false)) {
                    return [
                        'success' => 'Created "MenuItem" successfully',
                        'data' => $model,
                    ];
                }
            }
        }

        return [
            'success' => 'Error creating "MenuItem"',
            'errors' => $model->errors,
        ];
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if (!$model) {
            throw new NotFoundHttpException('Model topilmadi.');
        }

        $oldFile = $model->document;

        if ($this->request->isPost || $this->request->isPatch) {
            if ($model->load($this->request->post(), '') && $model->validate()) {
                $file = UploadedFile::getInstanceByName('document');

                if ($file) {
                    $model->document = $file;
                    if (!$model->uploadFile()) {
                        return [
                            'success' => false,
                            'message' => 'File upload failed',
                        ];
                    }
                } else {
                    $model->document = $oldFile;
                }

                if ($model->save(false)) {
                    return [
                        'success' => true,
                        'message' => 'Update "MenuItem" successfully',
                        'data' => $model,
                    ];
                }
            }
        }

        return [
            'success' => false,
            'message' => 'Error updating "MenuItem"',
            'errors' => $model->errors,
        ];
    }


    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->status = MenuItem::STATUS_DELETED;
        $model->deleted_at = date('U');
        $model->save();

        return array(
            'status' => 1,
            'message' => 'successfully deleted'
        );
    }

    protected
    function findModel($id)
    {
        if (($model = MenuItem::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested menuItem.id does not exist.');
    }
}

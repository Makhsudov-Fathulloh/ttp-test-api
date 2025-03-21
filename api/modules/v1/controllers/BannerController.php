<?php

namespace api\modules\v1\controllers;

use api\models\Banner;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

/**
 * User controller for the `v1` module
 */
class BannerController extends ApiController
{
    public $data = 'banner';

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Banner::find()
        ]);

        return $dataProvider;
    }

    public function actionView($id)
    {
        return $this->findModel($id);
    }

    public function actionCreate()
    {
        $model = new Banner();

        if ($this->request->isPost) {
            if ($model->load($this->request->post(), '') && $model->validate()) {
                $model->document = UploadedFile::getInstanceByName('document');
                if ($model->uploadFile() && $model->save(false)) {
                    return [
                        'success' => 'Created "Banner" successfully',
                        'data' => $model,
                    ];
                }
            }
        }

        return [
            'success' => 'Error creating "Banner"',
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
                        'message' => 'Update "Banner" successfully',
                        'data' => $model,
                    ];
                }
            }
        }

        return [
            'success' => false,
            'message' => 'Error updating "Banner"',
            'errors' => $model->errors,
        ];
    }


    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->status = Banner::STATUS_DELETED;
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
        if (($model = Banner::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested banner.id does not exist.');
    }
}

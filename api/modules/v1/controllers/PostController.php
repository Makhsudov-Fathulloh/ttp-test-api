<?php

namespace api\modules\v1\controllers;

use api\models\Post;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

/**
 * User controller for the `v1` module
 */
class PostController extends ApiController
{
    public $data = 'post';

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Post::find()
        ]);

        return $dataProvider;
    }

    public function actionView($id)
    {
        return $this->findModel($id);
    }

    public function actionCreate()
    {
        $model = new Post();

        if ($this->request->isPost) {
            if ($model->load($this->request->post(), '') && $model->validate()) {
                $model->document = UploadedFile::getInstanceByName('document');

                if ($model->uploadFile() && $model->save(false)) {
                    return [
                        'success' => 'Created "Post" successfully',
                        'data' => $model,
                    ];
                }
            }
        }

        return [
            'success' => 'Error creating "Post"',
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
                        'message' => 'Update "Post" successfully',
                        'data' => $model,
                    ];
                }
            }
        }

        return [
            'success' => false,
            'message' => 'Error updating "Post"',
            'errors' => $model->errors,
        ];
    }


    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->status = Post::STATUS_DELETED;
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
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested post.id does not exist.');
    }
}

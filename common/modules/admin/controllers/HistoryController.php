<?php

namespace common\modules\admin\controllers;

use common\models\History;
use common\models\search\HistorySearch;
use Yii;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

/**
 * HistoryController implements the CRUD actions for History model.
 */
class HistoryController extends ModuleController
{
    /**
     * Lists all History models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new HistorySearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single History model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new History model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new History();

        if ($this->request->isPost && $model->load($this->request->post())) {
            $model->document = UploadedFile::getInstance($model, 'document');

            if (!$model->validate()) {
                Yii::$app->session->setFlash('error', json_encode($model->errors));
                return $this->render('create', ['model' => $model]);
            }

            if (!$model->uploadFile()) {
                return $this->render('create', ['model' => $model]);
            }

            if ($model->save(false)) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing History model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if (!$model) {
            throw new NotFoundHttpException('Model topilmadi.');
        }

        $oldFile = $model->document;

        if ($this->request->isPost  && $model->load($this->request->post())) {
            $model->document = UploadedFile::getInstance($model, 'document');

            if (!$model->validate()) {
                Yii::$app->session->setFlash('error', json_encode($model->errors));
                return $this->render('update', ['model' => $model]);
            }

            if ($model->document) {
                if (!$model->uploadFile()) {
                    return $this->render('update', ['model' => $model]);
                }
                @unlink(Yii::getAlias('@static/uploads/') . $oldFile);
            } else {
                $model->document = $oldFile;
            }

            if ($model->save(false)) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing History model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->status = History::STATUS_DELETED;
        $model->deleted_at = date('U');
        $model->save();

        return $this->redirect(['index']);
    }

    /**
     * Finds the History model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return History the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = History::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}

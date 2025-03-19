<?php

namespace common\modules\admin\controllers;

use common\models\Station;
use common\models\search\StationSearch;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

/**
 * StationController implements the CRUD actions for Station model.
 */
class StationController extends ModuleController
{
    /**
     * Lists all Station models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new StationSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        $regionId = ArrayHelper::map(
            \common\models\Region::find()
                ->select(['id', 'title'])
                ->asArray()
                ->all(),
            'id',
            'title'
        );

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'regionId' => $regionId,
        ]);
    }

    /**
     * Displays a single Station model.
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
     * Creates a new Station model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Station();

        if ($this->request->isPost && $model->load($this->request->post())) {
            $model->document = UploadedFile::getInstance($model, 'document');

            if (!$model->validate()) {
                Yii::error('Validation Error: ' . json_encode($model->errors), __METHOD__);
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
     * Updates an existing Station model.
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

        $oldFile = $model->document; // Eski faylni saqlab qolish

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
     * Deletes an existing Station model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->status = Station::STATUS_DELETED;
        $model->deleted_at = date('U');
        $model->save();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Station model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Station the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Station::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}

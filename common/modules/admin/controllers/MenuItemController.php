<?php

namespace common\modules\admin\controllers;

use common\models\MenuItem;
use common\models\search\MenuItemSearch;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * MenuItemController implements the CRUD actions for MenuItem model.
 */
class MenuItemController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::class,
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all MenuItem models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new MenuItemSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        $menuId = ArrayHelper::map(
            \common\models\Menu::find()
                ->select(['id', 'title'])
                ->asArray()
                ->all(),
            'id',
            'title'
        );

        $menuIdParentId = ArrayHelper::map(
            \common\models\MenuItem::find()
                ->where(['IS NOT', 'menu_id_parent_id', null])
                ->select(['menu_id_parent_id', 'title'])
                ->asArray()
                ->all(),
            'id',
            'title'
        );
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'menuId' => $menuId,
            'menuIdParentId' => $menuIdParentId,
        ]);
    }

    /**
     * Displays a single MenuItem model.
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
     * Creates a new MenuItem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new MenuItem();

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

            if (Yii::$app->request->post('returnUrl')) {
                return $this->redirect(Yii::$app->request->post('returnUrl'));
            }
        }

        return $this->render('create', ['model' => $model]);
    }

    /**
     * Updates an existing MenuItem model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = MenuItem::findOne($id);
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

            if (Yii::$app->request->post('returnUrl')) {
                return $this->redirect(Yii::$app->request->post('returnUrl'));
            }
        }

        return $this->render('update', ['model' => $model]);
    }


    /**
     * Deletes an existing MenuItem model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->status = MenuItem::STATUS_DELETED;
        $model->deleted_at = date('U');
        $model->save();

        return $this->redirect(['index']);
    }

    /**
     * Finds the MenuItem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return MenuItem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MenuItem::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}

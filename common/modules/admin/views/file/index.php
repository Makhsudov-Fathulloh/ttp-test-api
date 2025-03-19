<?php

use common\models\File;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\FileSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Files');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="file-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create File'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'description',
            'file',
            'ext',
            'folder',
            //'domain',
            [
                'attribute' => 'user_id',
                'value' => function ($model) {
                    return $model->user ? $model->user->username : null;
                },
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'user_id', $userId,
                    ['class' => 'form-control selectpicker', 'style' => 'width:100%', 'data-style' => "form-control", 'prompt' => 'Выберите меню']
                ),
            ],
            'path',
            //'size',
            'downloads',
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, File $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>

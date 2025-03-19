<?php

use common\models\History;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\HistorySearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Histories');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="history-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create History'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
//            'slug',
            'description',
            'type',

            'file_id',
//            [
//                'attribute' => 'file_id',
//                'format' => 'html',
//                'value' => function ($model) {
//                    return $model->file->path
//                        ? Html::img($model->file->path, ['width' => '70px'])
//                        : 'No image';
//                }
//            ],            'documents',

            'anons',
            'content',
            [
                'attribute' => 'status',
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'status',
                    [
                        History::STATUS_ACTIVE => 'Активный',
                        History::STATUS_INACTIVE => 'Неактивный',
                        History::STATUS_DELETED => 'Удаленный'
                    ],
                    ['class' => 'form-control selectpicker', 'style' => 'width:100%', 'data-style' => "form-control"]
                ),
                'value' => function ($model) {
                    return $model->status == History::STATUS_ACTIVE ? 'Активный' : ($model->status == History::STATUS_INACTIVE ? 'Неактивный' : 'Удаленный');
                }
            ],
            'views',

            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, History $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>

<?php

use common\models\Post;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\PostSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Posts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Post'), ['create'], ['class' => 'btn btn-success']) ?>
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
//            ],

            'top',
            'user_id',
            'video',
            //'documents',
            //'content',
            [
                'attribute' => 'status',
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'status',
                    [
                        Post::STATUS_ACTIVE => 'Активный',
                        Post::STATUS_INACTIVE => 'Неактивный',
                        Post::STATUS_DELETED => 'Удаленный'
                    ],
                    ['class' => 'form-control selectpicker', 'style' => 'width:100%', 'data-style' => "form-control"]
                ),
                'value' => function ($model) {
                    return $model->status == Post::STATUS_ACTIVE ? 'Активный' : ($model->status == Post::STATUS_INACTIVE ? 'Неактивный' : 'Удаленный');
                }
            ],            //'views',

            [
                'attribute' => 'published_at',
                'filter' => Html::activeTextInput(
                    $searchModel, 'published_at', ['id' => 'index-published-at', 'class' => 'form-control v-align-middle']
                ),
                'contentOptions' => ['class' => 'v-align-middle'],
                'format' => 'raw',
                'value' => function ($model) {
                    return is_numeric($model->published_at) ? date("d.m.Y", $model->published_at) : $model->published_at;
                }
            ],

            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, Post $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>

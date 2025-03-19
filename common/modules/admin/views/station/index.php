<?php

use common\models\Station;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\StationSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Stations');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="station-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Station'), ['create'], ['class' => 'btn btn-success']) ?>
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
            'address',
            'phone',
            'fax',
            'email:email',
            [
                'attribute' => 'region_id',
                'value' => 'region.title',
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'region_id', $regionId,
                    ['class' => 'form-control selectpicker', 'style' => 'width:100%', 'data-style' => "form-control", 'prompt' => 'Выберите регион']
                ),
            ],

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

            'lat',
            'long',
            [
                'attribute' => 'status',
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'status',
                    [
                        Station::STATUS_ACTIVE => 'Активный',
                        Station::STATUS_INACTIVE => 'Неактивный',
                        Station::STATUS_DELETED => 'Удаленный'
                    ],
                    ['class' => 'form-control selectpicker', 'style' => 'width:100%', 'data-style' => "form-control"]
                ),
                'value' => function ($model) {
                    return $model->status == Station::STATUS_ACTIVE ? 'Активный' : ($model->status == Station::STATUS_INACTIVE ? 'Неактивный' : 'Удаленный');
                }
            ],

            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, Station $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>

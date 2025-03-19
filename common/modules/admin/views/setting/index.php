<?php

use common\models\Setting;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\SettingSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Settings');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="setting-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Setting'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'alias',
            'value',
            'link',

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

            'sort',
            [
                'attribute' => 'status',
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'status',
                    [
                        Setting::STATUS_ACTIVE => 'Активный',
                        Setting::STATUS_INACTIVE => 'Неактивный',
                        Setting::STATUS_DELETED => 'Удаленный'
                    ],
                    ['class' => 'form-control selectpicker', 'style' => 'width:100%', 'data-style' => "form-control"]
                ),
                'value' => function ($model) {
                    return $model->status == Setting::STATUS_ACTIVE ? 'Активный' : ($model->status == Setting::STATUS_INACTIVE ? 'Неактивный' : 'Удаленный');
                }
            ],            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, Setting $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>

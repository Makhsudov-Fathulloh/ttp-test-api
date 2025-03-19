<?php

use common\models\WidgetItem;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\WidgetItemSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Widget Items');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="widget-items-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Widget Items'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'widget_id',
                'value' => 'widget.title',
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'widget_id', $widgetId,
                    ['class' => 'form-control selectpicker', 'style' => 'width:100%', 'data-style' => "form-control", 'prompt' => 'Выберите меню']
                ),
            ],            'title',
            'description',
            'secondary',
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
                'attribute' => 'parent_id',
                'value' => function ($model) {
                    return $model->parentId ? $model->parentId->title : null;
                },
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'parent_id', $parentId,
                    ['class' => 'form-control selectpicker', 'style' => 'width:100%', 'data-style' => "form-control", 'prompt' => 'Выберите меню']
                ),
            ],
            [
                'attribute' => 'status',
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'status',
                    [
                        WidgetItem::STATUS_ACTIVE => 'Активный',
                        WidgetItem::STATUS_INACTIVE => 'Неактивный',
                        WidgetItem::STATUS_DELETED => 'Удаленный'
                    ],
                    ['class' => 'form-control selectpicker', 'style' => 'width:100%', 'data-style' => "form-control"]
                ),
                'value' => function ($model) {
                    return $model->status == WidgetItem::STATUS_ACTIVE ? 'Активный' : ($model->status == WidgetItem::STATUS_INACTIVE ? 'Неактивный' : 'Удаленный');
                }
            ],

            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, WidgetItem $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>

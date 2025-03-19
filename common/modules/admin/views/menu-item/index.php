<?php

use common\models\MenuItem;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\MenuItemSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Menu Items');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-items-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Menu Items'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'menu_id',
                'value' => 'menu.title', // Menu jadvalidagi title ni chiqarish
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'menu_id', $menuId,
                    ['class' => 'form-control selectpicker', 'style' => 'width:100%', 'data-style' => "form-control", 'prompt' => 'Выберите меню']
                ),
            ],
            'title',
//            'url:url',

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
                'attribute' => 'menu_id_parent_id',
                'value' => function ($model) {
                    return $model->menuIdParent ? $model->menuIdParent->title : null;
                },
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'menu_id_parent_id', $menuIdParentId,
                    ['class' => 'form-control selectpicker', 'style' => 'width:100%', 'data-style' => "form-control", 'prompt' => 'Выберите меню']
                ),
            ],
            [
                'attribute' => 'status',
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'status',
                    [
                        MenuItem::STATUS_ACTIVE => 'Активный',
                        MenuItem::STATUS_INACTIVE => 'Неактивный',
                        MenuItem::STATUS_DELETED => 'Удаленный'
                    ],
                    ['class' => 'form-control selectpicker', 'style' => 'width:100%', 'data-style' => "form-control"]
                ),
                'value' => function ($model) {
                    return $model->status == MenuItem::STATUS_ACTIVE ? 'Активный' : ($model->status == MenuItem::STATUS_INACTIVE ? 'Неактивный' : 'Удаленный');
                }
            ],

            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, MenuItem $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>

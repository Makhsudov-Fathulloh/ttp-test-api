<?php

use common\models\Region;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\RegionSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Regions');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="region-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Region'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'code',
            'country_id',
            [
                'attribute' => 'status',
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'status',
                    [
                        Region::STATUS_ACTIVE => 'Активный',
                        Region::STATUS_INACTIVE => 'Неактивный',
                        Region::STATUS_DELETED => 'Удаленный'
                    ],
                    ['class' => 'form-control selectpicker', 'style' => 'width:100%', 'data-style' => "form-control"]
                ),
                'value' => function ($model) {
                    return $model->status == Region::STATUS_ACTIVE ? 'Активный' : ($model->status == Region::STATUS_INACTIVE ? 'Неактивный' : 'Удаленный');
                }
            ],

            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, Region $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>

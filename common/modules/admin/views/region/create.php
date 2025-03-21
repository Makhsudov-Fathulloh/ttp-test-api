<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Region $model */

$this->title = Yii::t('app', 'Create Region');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Regions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="region-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

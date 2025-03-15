<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Station $model */

$this->title = Yii::t('app', 'Create Station');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Stations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="station-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

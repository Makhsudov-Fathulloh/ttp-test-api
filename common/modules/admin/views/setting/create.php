<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Setting $model */

$this->title = Yii::t('app', 'Create Setting');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Settings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="setting-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

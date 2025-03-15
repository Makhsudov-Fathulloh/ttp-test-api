<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Calls $model */

$this->title = Yii::t('app', 'Create Calls');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Calls'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="calls-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

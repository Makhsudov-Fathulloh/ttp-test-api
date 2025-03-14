<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\WidgetItem $model */

$this->title = Yii::t('app', 'Create Widget Items');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Widget Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="widget-items-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

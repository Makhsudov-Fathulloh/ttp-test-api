<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Widget $model */

$this->title = Yii::t('app', 'Create Widget');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Widget'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="widgets-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

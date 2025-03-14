<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Menus $model */

$this->title = Yii::t('app', 'Create Menus');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Menuses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menus-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

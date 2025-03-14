<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\MenuItems $model */

$this->title = Yii::t('app', 'Create Menu Items');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Menu Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-items-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

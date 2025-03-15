<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\search\HistorySearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="history-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'title') ?>

<!--    --><?php //= $form->field($model, 'slug') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'type') ?>

    <?php  echo $form->field($model, 'file_id') ?>

    <?php  echo $form->field($model, 'documents') ?>

    <?php  echo $form->field($model, 'anons') ?>

    <?php  echo $form->field($model, 'content') ?>

    <?php  echo $form->field($model, 'status') ?>

<!--    --><?php // echo $form->field($model, 'views') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

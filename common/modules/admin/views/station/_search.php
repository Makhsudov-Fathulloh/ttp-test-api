<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\search\StationSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="station-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'title') ?>

<!--    --><?php //= $form->field($model, 'slug') ?>

    <?= $form->field($model, 'address') ?>

    <?= $form->field($model, 'phone') ?>

    <?php // echo $form->field($model, 'fax') ?>

    <?php  echo $form->field($model, 'email') ?>

    <?php  echo $form->field($model, 'region_id') ?>

<!--    --><?php // echo $form->field($model, 'file_id') ?>

    <?php  echo $form->field($model, 'lat') ?>

    <?php  echo $form->field($model, 'long') ?>

    <?php  echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

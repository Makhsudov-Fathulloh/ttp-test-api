<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\search\FileSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="file-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'file') ?>

    <?= $form->field($model, 'ext') ?>

    <?php // echo $form->field($model, 'slug') ?>

    <?php // echo $form->field($model, 'domain') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'folder_id') ?>

    <?php // echo $form->field($model, 'path') ?>

    <?php // echo $form->field($model, 'size') ?>

    <?php // echo $form->field($model, 'downloads') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

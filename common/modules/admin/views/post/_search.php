<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\search\PostSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="post-search">

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

    <?php  echo $form->field($model, 'top') ?>

    <?php  echo $form->field($model, 'user_id') ?>

    <?php  echo $form->field($model, 'video') ?>

    <?php // echo $form->field($model, 'documents') ?>

    <?php // echo $form->field($model, 'content') ?>

    <?php  echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'views') ?>

    <?php  echo $form->field($model, 'published_at') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

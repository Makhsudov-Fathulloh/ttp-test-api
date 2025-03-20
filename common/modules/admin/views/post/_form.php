<?php

use common\models\Post;
use kartik\file\FileInput;
use mihaildev\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Post $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->widget(CKEditor::class, [
        'options' => ['rows' => 6],
    ]) ?>

    <?= $form->field($model, 'type')->textInput() ?>

    <?= $form->field($model, 'document')->label('File')->widget(FileInput::class, [
        'options' => ['multiple' => false],
        'pluginOptions' => [
            'showUpload' => false,
            'allowedFileExtensions' => ['jpg', 'png', 'svg', 'pdf', 'docx'],
        ],
    ]); ?>
    <?= $form->field($model, 'top')->textInput() ?>

    <?= $form->field($model, 'video')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'documents')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList([
        Post::STATUS_ACTIVE => 'Активный',
        Post::STATUS_INACTIVE => 'Неактивный',
        Post::STATUS_DELETED => 'Удаленный'
    ], ['class' => 'form-control selectpicker', 'style' => 'width:100%', 'data-style' => "form-control"]) ?>

    <?= $form->field($model, 'views')->textInput() ?>
    <br>

    <?php if (Yii::$app->controller->action->id == "create") {
        $model->published_at = date('d-m-Y');
    } ?>

    <?= $form->field($model, 'published_at')->widget(DatePicker::class, ['dateFormat' => 'php:d-m-Y']) ?>
    <br>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

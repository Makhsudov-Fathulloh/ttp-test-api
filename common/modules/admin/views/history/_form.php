<?php

use common\models\History;
use kartik\file\FileInput;
use mihaildev\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\History $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="history-form">

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
            'allowedFileExtensions' => ['jpg', 'png', 'pdf', 'docx'],
        ],
    ]); ?>

    <?= $form->field($model, 'documents')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'anons')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->widget(CKEditor::class, [
        'options' => ['rows' => 6],
    ]) ?>
    <?= $form->field($model, 'status')->dropDownList([
        History::STATUS_ACTIVE => 'Активный',
        History::STATUS_INACTIVE => 'Неактивный',
        History::STATUS_DELETED => 'Удаленный'
    ], ['class' => 'form-control selectpicker', 'style' => 'width:100%', 'data-style' => "form-control"]) ?>
    <br>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

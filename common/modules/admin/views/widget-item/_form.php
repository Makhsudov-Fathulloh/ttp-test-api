<?php

use common\models\WidgetItem;
use kartik\file\FileInput;
use kartik\select2\Select2;
use mihaildev\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\WidgetItem $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="widget-items-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'widget_id')->widget(Select2::class, [
        'data' => \common\models\Widget::getWidgetList(),
        'options' => [
            'placeholder' => 'Select Widget...',
            'onchange' => 'this.form.submit()'
        ],
        'pluginOptions' => [
            'allowClear' => false,
            'multiple' => false
        ],
    ]) ?>
    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->widget(CKEditor::class, [
        'options' => ['rows' => 6],
    ]) ?>

    <?= $form->field($model, 'secondary')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'document')->widget(FileInput::class, [
        'options' => ['multiple' => false],
        'pluginOptions' => [
            'showUpload' => false,
            'allowedFileExtensions' => ['jpg', 'png', 'pdf', 'docx'],
        ],
    ]); ?>

    <?= $form->field($model, 'sort')->textInput() ?>

    <?= $form->field($model, 'parent_id')->widget(Select2::class, [
        'data' => \common\models\WidgetItem::getWidgetItemList($model->widget_id, $model->id),
        'options' => [
                'placeholder' => 'Select MenuItem...',
                'disabled' => !$model->widget_id
            ],
        'pluginOptions' => [
            'allowClear' => true,
            'multiple' => false
        ],
    ]) ?>
    <?= $form->field($model, 'status')->dropDownList([
        WidgetItem::STATUS_ACTIVE => 'Активный',
        WidgetItem::STATUS_INACTIVE => 'Неактивный',
        WidgetItem::STATUS_DELETED => 'Удаленный'
    ], ['class' => 'form-control selectpicker', 'style' => 'width:100%', 'data-style' => "form-control"]) ?>
    <br>

    <?= Html::hiddenInput('returnUrl', Yii::$app->request->url); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

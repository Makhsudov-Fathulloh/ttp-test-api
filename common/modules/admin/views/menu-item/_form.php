<?php

use common\models\MenuItem;
use kartik\file\FileInput;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\MenuItem $model */
/** @var yii\widgets\ActiveForm $form */

?>

<div class="menu-items-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput() ?>

    <?= $form->field($model, 'menu_id')->widget(Select2::class, [
        'data' => \common\models\Menu::getMenuList(),
        'options' => [
            'placeholder' => 'Select Menu...',
            'onchange' => 'this.form.submit()'
        ],
        'pluginOptions' => [
            'allowClear' => false,
            'multiple' => false
        ],
    ]) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'document')->widget(FileInput::class, [
        'options' => ['multiple' => false],
        'pluginOptions' => [
            'showUpload' => false,
            'allowedFileExtensions' => ['jpg', 'png', 'pdf', 'docx'],
        ],
    ]); ?>

    <?= $form->field($model, 'sort')->textInput() ?>

    <?= $form->field($model, 'menu_id_parent_id')->widget(Select2::class, [
        'data' => $model->menu_id ? \common\models\MenuItem::getMenuItemList($model->menu_id, $model->id) : [],
        'options' => [
            'placeholder' => 'Select MenuItem...',
            'disabled' => !$model->menu_id
        ],
        'pluginOptions' => [
            'allowClear' => true,
            'multiple' => false
        ],
    ]) ?>

    <?= $form->field($model, 'status')->dropDownList([
        MenuItem::STATUS_ACTIVE => 'Активный',
        MenuItem::STATUS_INACTIVE => 'Неактивный',
        MenuItem::STATUS_DELETED => 'Удаленный'
    ], ['class' => 'form-control selectpicker', 'style' => 'width:100%', 'data-style' => "form-control"]) ?>
    <br>

    <?= Html::hiddenInput('returnUrl', Yii::$app->request->url); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

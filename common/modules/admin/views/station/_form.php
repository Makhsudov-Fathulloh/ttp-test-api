<?php

use common\models\Station;
use kartik\file\FileInput;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Station $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="station-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fax')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'region_id')->widget(Select2::class, [
        'data' => \common\models\Region::getRegionList(),
        'options' => [
            'placeholder' => 'Select Region...'
        ],
        'pluginOptions' => [
            'allowClear' => false,
            'multiple' => false
        ],
    ]) ?>

    <?= $form->field($model, 'document')->widget(FileInput::class, [
        'options' => ['multiple' => false],
        'pluginOptions' => [
            'showUpload' => false,
            'allowedFileExtensions' => ['jpg', 'png', 'svg', 'pdf', 'docx'],
        ],
    ]); ?>
    <?= $form->field($model, 'lat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'long')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList([
        Station::STATUS_ACTIVE => 'Активный',
        Station::STATUS_INACTIVE => 'Неактивный',
        Station::STATUS_DELETED => 'Удаленный'
    ], ['class' => 'form-control selectpicker', 'style' => 'width:100%', 'data-style' => "form-control"]) ?>
    <br>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

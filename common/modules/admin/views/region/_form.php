<?php

use common\models\Region;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Region $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="region-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'code')->textInput() ?>

    <?= $form->field($model, 'country_id')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList([
        Region::STATUS_ACTIVE => 'Активный',
        Region::STATUS_INACTIVE => 'Неактивный',
        Region::STATUS_DELETED => 'Удаленный'
    ], ['class' => 'form-control selectpicker', 'style' => 'width:100%', 'data-style' => "form-control"]) ?>
    <br>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

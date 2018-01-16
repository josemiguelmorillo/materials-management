<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SubOrderLines */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sub-order-lines-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($subOrderLineForm->subOrderLines, 'id_suborder')->textInput() ?>

    <!--<?//= $form->field($subOrderLineForm->subOrderLines, 'item_id')->textInput() ?>-->
    <?= $form->field($subOrderLineForm->subOrderLines, 'item_id')->dropDownList($items, ['prompt'=>''] ) ?>

    <?= $form->field($subOrderLineForm->subOrderLines, 'unit')->textInput() ?>

    <?= $form->field($subOrderLineForm->subOrderLines, 'unit_price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($subOrderLineForm->subOrderLines, 'discount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($subOrderLineForm->lineDetails, 'degree_id')->dropDownList($degrees, ['prompt'=>''] ) ?>
    <?= $form->field($subOrderLineForm->lineDetails, 'teacher_id')->dropDownList($teachers, ['prompt'=>''] ) ?>
    <?= $form->field($subOrderLineForm->lineDetails, 'class_id')->dropDownList($classes, ['prompt'=>''] ) ?>
    <?= $form->field($subOrderLineForm->lineDetails, 'subject_id')->dropDownList($subjects, ['prompt'=>''] ) ?>


    <div class="form-group">
        <?= Html::submitButton($subOrderLineForm->subOrderLines->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $subOrderLineForm->subOrderLines->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

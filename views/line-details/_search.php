<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LineDetailsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="line-details-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'line_detail_id') ?>

    <?= $form->field($model, 'degree_id') ?>

    <?= $form->field($model, 'teacher_id') ?>

    <?= $form->field($model, 'class_id') ?>

    <?= $form->field($model, 'subject_id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

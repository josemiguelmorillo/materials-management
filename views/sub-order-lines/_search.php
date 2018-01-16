<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SubOrderLinesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sub-order-lines-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'suborder_line_id') ?>

    <?= $form->field($model, 'id_suborder') ?>

    <?= $form->field($model, 'item_id') ?>

    <?= $form->field($model, 'unit') ?>

    <?= $form->field($model, 'unit_price') ?>

    <?php // echo $form->field($model, 'discount') ?>

    <?php // echo $form->field($model, 'line_detail_id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

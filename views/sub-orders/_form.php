<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SubOrders */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sub-orders-form">

    <?php $form = ActiveForm::begin(); ?>

    <!--<? //= $form->field($model, 'order_id')->textInput() ?>-->
    <?= $form->field($model, 'order_id')->dropDownList($orders, ['prompt' => '']) ?>
    <!--<? //= $form->field($model, 'supplier_id')->textInput() ?>-->
    <?= $form->field($model, 'supplier_id')->dropDownList($suppliers, ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

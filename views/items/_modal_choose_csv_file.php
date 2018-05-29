<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\widgets\Pjax;

?>
<div class="modal-body">
    <div class="modal-title">
        <h4><?= Yii::t('app', 'Import Catalog') ?></h4>
    </div>
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data'], 'method' => 'post',
        'action' => ['items/import'],
    ]) ?>

    <div class="form-group">
        <?= $form->field($model, 'supplier_id')->dropDownList($suppliers, ['prompt' => '']) ?>
        <?= $form->field($model, 'item_category_id')->dropDownList($itemCategories, ['prompt' => '']) ?>
    </div>

    <div class="form-group">
        <?= $form->field($model, 'catalog_file')->fileInput() ?>
    </div>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Import'), ['class' => 'btn btn-success']) ?>
        <span class="btn btn-primary" , data-dismiss="modal" aria-label="Close">cancel</span>
    </div>

    <?php ActiveForm::end() ?>

</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SubOrders */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Sub Orders',
]) . $model->id_suborder;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sub Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_suborder, 'url' => ['view', 'id' => $model->id_suborder]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="sub-orders-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'suppliers' => $suppliers,
        'orders' => $orders,
    ]) ?>

</div>

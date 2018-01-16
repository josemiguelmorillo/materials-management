<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SubOrders */

$this->title = Yii::t('app', 'Create Sub Orders');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sub Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sub-orders-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'suppliers' => $suppliers,
        'orders' => $orders,
    ]) ?>

</div>

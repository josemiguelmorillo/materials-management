<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SubOrders */

$this->title = $model->id_suborder;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sub Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sub-orders-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id_suborder], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id_suborder], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a(Yii::t('app', 'Add item'), ['add-supplier-item', 'id' => $model->id_suborder], [
            'class' => 'btn btn-primary',
            'data' => [
//                'confirm' => Yii::t('app', 'Are you sure you want to order to this supplier?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_suborder',
            'order_id',
//            'supplier_id',
            'supplier.name',
        ],
    ]) ?>

</div>

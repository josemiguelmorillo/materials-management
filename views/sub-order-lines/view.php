<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SubOrderLines */

$this->title = $model->suborder_line_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sub Order Lines'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sub-order-lines-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->suborder_line_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->suborder_line_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'suborder_line_id',
            'id_suborder',
            'item_id',
            'item.supplier_reference',
            'unit',
            'unit_price',
            'discount',
            'line_detail_id',
        ],
    ]) ?>

</div>

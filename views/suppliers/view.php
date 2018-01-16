<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Suppliers */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Suppliers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="suppliers-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->supplier_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->supplier_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a(Yii::t('app', 'Order'), ['create-supplier-order', 'id' => $model->supplier_id], [
            'class' => 'btn btn-primary',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to order to this supplier?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'supplier_id',
            'name',
            'legal_name',
            'cif',
            'address',
            'phone_number',
            'contact_name',
            'contact_phone',
            'www',
            'email:email',
        ],
    ]) ?>

</div>

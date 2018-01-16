<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\LineDetails */

$this->title = $model->line_detail_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Line Details'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="line-details-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->line_detail_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->line_detail_id], [
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
            'line_detail_id',
            'degree_id',
            'teacher_id',
            'class_id',
            'subject_id',
        ],
    ]) ?>

</div>

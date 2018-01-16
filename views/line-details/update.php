<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\LineDetails */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Line Details',
]) . $model->line_detail_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Line Details'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->line_detail_id, 'url' => ['view', 'id' => $model->line_detail_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="line-details-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

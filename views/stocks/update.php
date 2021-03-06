<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Stocks */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Stocks',
]) . $model->stock_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Stocks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->stock_id, 'url' => ['view', 'id' => $model->stock_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="stocks-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

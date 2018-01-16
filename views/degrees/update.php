<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Degrees */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Degrees',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Degrees'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->degree_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="degrees-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

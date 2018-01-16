<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\LineDetails */

$this->title = Yii::t('app', 'Create Line Details');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Line Details'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="line-details-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SubOrderLines */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Sub Order Lines',
]) . $subOrderLineForm->subOrderLines->suborder_line_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sub Order Lines'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $subOrderLineForm->subOrderLines->suborder_line_id, 'url' => ['view', 'id' => $subOrderLineForm->subOrderLines->suborder_line_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="sub-order-lines-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'subOrderLineForm' => $subOrderLineForm,
        'degrees' => $degrees,
        'teachers' => $teachers,
        'classes' => $classes,
        'subjects' => $subjects,
        'items'=> $items,
    ]) ?>

</div>

<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SubOrderLines */

$this->title = Yii::t('app', 'Create Sub Order Lines');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sub Order Lines'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sub-order-lines-create">

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

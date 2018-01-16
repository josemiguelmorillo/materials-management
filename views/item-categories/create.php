<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ItemCategories */

$this->title = Yii::t('app', 'Create Item Categories');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Item Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-categories-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

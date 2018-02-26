<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ItemsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Items');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="items-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Items'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Import Items'), ['import'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>   <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            [
//                    'attribute' => 'item_id',
//               'headerOptions' => ['style' => 'width:5%'],
//            ],
            //'supplier_id',
            [
                'attribute' => 'supplier',
                'value' => 'supplier.name',
                'headerOptions' => ['style' => 'width:10%'],
                'label' => Yii::t('app', 'Supplier'),

            ],
            //'item_category_id',
            [
                'attribute' => 'itemCategory',
                'value' => 'itemCategory.name',
                //'headerOptions' => ['style' => 'width:10%'],
                'label' => Yii::t('app', 'Category'),

            ],
            [
                    'attribute'=>'supplier_reference',
                'headerOptions' => ['style' => 'width:10%'],
            ],
            [
                    'attribute'=>'name',
                //'headerOptions' => ['style' => 'width:35%'],
            ],

             'brand',
             'model',
             'description:ntext',
            [
                'attribute' => 'price',
                'headerOptions' => ['style' => 'width:5%'],
            ],
             'comment:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?></div>

<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OrdersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Orders');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Orders'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?> <!--<? //= GridView::widget([
    //       // 'dataProvider' => $dataProvider,
    //        'filterModel' => $searchModel,
    //        'columns' => [
    //            ['class' => 'yii\grid\SerialColumn'],
    //
    //            'order_id',
    //            'value_date',
    //            'academic_year',
    //
    //            ['class' => 'yii\grid\ActionColumn'],
    //        ],
    //    ]); ?>-->
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'kartik\grid\ExpandRowColumn',
                'width' => '50px',
                'value' => function ($model, $key, $index, $column) {
                    return GridView::ROW_COLLAPSED;
                },
                'detailUrl' => 'view-order-detail',
                'headerOptions' => ['class' => 'kartik-sheet-style'],
                'expandOneOnly' => true
            ],
            'order_id',
            'value_date',
            'academic_year',
            'units',
            'amount',
            ['class' => 'yii\grid\ActionColumn'],
        ],

    ]);
    ?>
    <?php Pjax::end(); ?></div>

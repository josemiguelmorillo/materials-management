<?php

use app\models\SubOrderLines;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\SubOrdersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Sub Orders');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sub-orders-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Sub Orders'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <!--<?//= GridView::widget([
//        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
//        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
//            'id_suborder',
//            'order_id',
//            'supplier_id',
//           [
//                'attribute' => 'supplier',
//                'value' => 'supplier.name',
//            ],
//            ['class' => 'yii\grid\ActionColumn'],
//        ],
//    ]);
    ?>-->
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
                'detailUrl' => 'view-sub-order-detail',
                'headerOptions' => ['class' => 'kartik-sheet-style'],
                'expandOneOnly' => true
            ],
            'order_id',
            'id_suborder',
            [
                'attribute' => 'supplier',
                'value' => 'supplier.name',
            ],
            [
                'label' => 'Units',
                'value' => function ($model) {
                    $units = SubOrderLines::find()->where(['id_suborder' => $model->id_suborder])->sum('unit');
                    return $units;
                }
            ],
            [
                'label' => 'Amount',
                'value' => function ($model) {
                    return  SubOrderLines::find()->where(['id_suborder' => $model->id_suborder])->sum('unit * unit_price * (1 - (discount/100.00))');
                }
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],

    ]);
    ?>
<?php Pjax::end(); ?></div>

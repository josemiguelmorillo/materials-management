<?php

use kartik\alert\Alert;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\SubOrderLinesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Sub Order Lines');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sub-order-lines-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Sub Order Lines'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'showPageSummary' => true,
        'columns' => [
            ['class'=>'kartik\grid\SerialColumn'],
            'idSuborder.order.order_id',
            'suborder_line_id',
            'id_suborder',
//            'item_id',
            [
                'attribute' => 'item',
                'value'=> 'item.supplier_reference',
            ],
            //'unit',

            'unit_price',
             'discount',
            [
                'attribute'=>'unit',
                'width'=>'150px',
                'hAlign'=>'right',
                'format'=>['decimal', 0],
                'pageSummary'=>true
            ],
            [
                'class'=>'kartik\grid\FormulaColumn',
                'header'=>Yii::t('app','Final Price'),
                'value'=>function ($model, $key, $index, $widget) {
                    $p = compact('model', 'key', 'index');
                    return $widget->col(7, $p) * $widget->col(5, $p) * (1 - $widget->col(6, $p) /100);
                },
//                'mergeHeader'=>true,
                'width'=>'150px',
                'hAlign'=>'right',
                'format'=>['decimal', 2],
                'pageSummary'=>true
            ],
            // 'line_detail_id',

            ['class' => 'kartik\grid\ActionColumn',
                'template' => '{view} {receipt}',
                'buttons' => [
                    'receipt' => function($url, $model, $key) {     // render your custom button
                        return  $model->receipt_unit == 0 ? Html::a(Html::tag('span', '', ['class' => "glyphicon glyphicon-check"]), $url, ['title'=> 'Receipt']) : '';
                }
                ]
                ],
        ],
    ]); ?>

<?php Pjax::end(); ?></div>

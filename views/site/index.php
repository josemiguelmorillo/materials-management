<?php

/* @var $this yii\web\View */

use app\models\Orders;
use app\models\Teachers;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;

$this->title = \Yii::t('app', 'Materials Management');
?>
<div class="site-index">
    <?php
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'showPageSummary' => true,
        'pjax' => true,
        'striped' => true,
        'hover' => true,
        'panel' => ['type' => 'primary', 'heading' => 'Grid Grouping Example'],
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],
            'id_suborder',
            [
                'attribute' => 'order',
                'value' => 'order.order_id',
            ],

            [
                'attribute' => 'item',
                'value' => 'item.supplier_reference',
            ],

            [
                'attribute' => 'unit_price',
                'width' => '150px',
                'hAlign' => 'right',
                'format' => ['decimal'],
                'pageSummary' => true
            ],
            [
                'attribute' => 'discount',
                'width' => '150px',
                'hAlign' => 'right',
                'format' => ['decimal'],
                //'pageSummary' => true
            ],
            [
                'attribute' => 'unit',
                'width' => '150px',
                'hAlign' => 'right',
                'format' => ['decimal', 0],
                'pageSummary' => true
            ],
        ],
    ]);

    ?>
</div>

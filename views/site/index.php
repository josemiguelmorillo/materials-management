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
            [
                'attribute' => 'teacher_name',
                'group' => true,
                'groupFooter' => function ($model, $key, $index, $widget) { // Closure method
                    return [
                        'mergeColumns' => [[1, 4]], // columns to merge in summary
                        'content' => [             // content to show in each summary cell
                            1 => 'Summary (' . $model->teacher_name . ')',
                            6 => GridView::F_AVG,
                            7 => GridView::F_SUM,
                            8 => GridView::F_SUM,
                        ],
                        'contentFormats' => [      // content reformatting for each summary cell
                            6 => ['format' => 'number', 'decimals' => 2],
                            7 => ['format' => 'number', 'decimals' => 0],
                            8 => ['format' => 'number', 'decimals' => 2],
                        ],
                        'contentOptions' => [      // content html attributes for each summary cell
                            1 => ['style' => 'font-variant:small-caps'],
                            6 => ['style' => 'text-align:right'],
                            7 => ['style' => 'text-align:right'],
                            8 => ['style' => 'text-align:right'],
                        ],
                        // html attributes for group summary row
                        'options' => ['class' => 'danger', 'style' => 'font-weight:bold;']
                    ];
                }
            ],
            [
                'attribute' => 'order_id',
                'group' => true,
                'subGroupOf' => 1,
                'groupFooter' => function ($model, $key, $index, $widget) { // Closure method
                    return [
                        'mergeColumns' => [[2, 4]], // columns to merge in summary
                        'content' => [             // content to show in each summary cell
                            2 => 'Summary (' . $model->order_id . ')',
                            6 => GridView::F_AVG,
                            7 => GridView::F_SUM,
                            8 => GridView::F_SUM,
                        ],
                        'contentFormats' => [      // content reformatting for each summary cell
                            6 => ['format' => 'number', 'decimals' => 2],
                            7 => ['format' => 'number', 'decimals' => 0],
                            8 => ['format' => 'number', 'decimals' => 2],
                        ],
                        'contentOptions' => [      // content html attributes for each summary cell
                            2 => ['style' => 'font-variant:small-caps'],
                            6 => ['style' => 'text-align:right'],
                            7 => ['style' => 'text-align:right'],
                            8 => ['style' => 'text-align:right'],
                        ],
                        // html attributes for group summary row
                        'options'=>['class'=>'success','style'=>'font-weight:bold;']
                    ];
                }
            ],
            [
                'attribute' => 'id_suborder',
                'group' => true,
                'subGroupOf' => 2,
            ],
            [
                'attribute' => 'item_name',
                'pageSummary' => 'Page Summary',
                'pageSummaryOptions' => ['class' => 'text-right text-warning'],
            ],
            [
                'attribute' => 'discount',
                'width' => '150px',
                'hAlign' => 'right',
                'format' => ['decimal', 2],
                'pageSummary' => false,
                'pageSummaryFunc' => GridView::F_AVG
            ],
            [
                'attribute' => 'unit_price',
                'width' => '150px',
                'hAlign' => 'right',
                'format' => ['decimal', 2],
                'pageSummary' => true,
                'pageSummaryFunc' => GridView::F_AVG
            ],

            [
                'attribute' => 'units',
                'width' => '150px',
                'hAlign' => 'right',
                'format' => ['decimal', 0],
                'pageSummary' => true
            ],
            [
                'class' => 'kartik\grid\FormulaColumn',
                'header' => 'Total Amount',
                'value' => function ($model, $key, $index, $widget) {
                    $p = compact('model', 'key', 'index');
                    return $widget->col(6, $p) * $widget->col(7, $p) * (1 - $widget->col(5, $p) / 100);
                },
                'mergeHeader' => true,
                'width' => '150px',
                'hAlign' => 'right',
                'format' => ['decimal', 2],
                'pageSummary' => true
            ],
        ],
    ]);

    ?>
</div>

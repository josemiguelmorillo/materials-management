<?php
/**
 * Created by PhpStorm.
 * User: josemiguelmorillocallejon
 * Date: 18/01/18
 * Time: 06:53
 */

use app\models\SubOrderLines;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;


?>
<div class="user-view">

    <?=
    GridView::widget([
            'dataProvider' => $dataProvider,
            'responsive' => true,
            'layout' => "{items}",
            'emptyText' => 'No data',
            'columns' => [
                'id_suborder',
                'supplier.name',
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
                        return SubOrderLines::find()->where(['id_suborder' => $model->id_suborder])->sum('unit * unit_price * (1 - (discount/100.00))');
                    }
                ],
//        ['class' => 'yii\grid\ActionColumn',
//        'controller' => 'sub-orders'],
//         ],
                [
                    'class' => 'kartik\grid\ActionColumn',
                    'template' => '{view}',
                    'buttons' => [
                        'view' => function ($url, $model) {
                            $url = Url::to(['/sub-order-lines/index', 'SubOrderLinesSearch[id_suborder]' => $model->id_suborder]);
                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, ['title' => 'view']);
                        },
                    ],
                ],
            ]
        ]
    );
    ?>
</div>

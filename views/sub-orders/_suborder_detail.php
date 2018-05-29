<?php
/**
 * Created by PhpStorm.
 * User: josemiguelmorillocallejon
 * Date: 18/01/18
 * Time: 06:53
 */

use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;


?>
<div class="user-view">

    <?=
    GridView::widget(
        [
            'dataProvider' => $dataProvider,
            'responsive' => true,
            'layout' => "{items}",
            'emptyText' => 'No data',
            'columns' => [
                'suborder_line_id',
                //'id_suborder',
                'item.supplier_reference',
                'unit',
                'unit_price',
                'discount',
            [
                'class' => 'yii\grid\ActionColumn',
                'controller' => 'sub-order-lines'],
            ],
        ]
    );
    ?>
</div>

<?php
/**
 * Created by PhpStorm.
 * User: josemiguelmorillocallejon
 * Date: 18/01/18
 * Time: 06:53
 */

use kartik\grid\GridView;


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
            $units = \app\models\SubOrderLines::find()->where(['id_suborder' => $model->id_suborder])->sum('unit');
            return $units;
          }
        ],
        [
            'label' => 'Amount',
            'value' => function ($model) {
                return  \app\models\SubOrderLines::find()->where(['id_suborder' => $model->id_suborder])->sum('unit * unit_price * (1 - (discount/100.00))');
            }
        ],
        ['class' => 'yii\grid\ActionColumn',
        'controller' => 'sub-orders'],
    ],
    ]);
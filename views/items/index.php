<?php

use yii\bootstrap\Modal;
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
        <?= Html::a('<span class="btn btn-success">Import Catalog</span>',
            ['/items/show-import-modal'],
            [
                'title' => 'Import Catalog',
                'data-toggle' => 'modal',
                'data-target' => '#modal-import',
            ]
        );
        ?>
    </p>
    <?php Pjax::begin(); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            //'layout' => '{summary}{items}{pager}',
            'layout' => '{summary}{pager}<div class="horizontal-bar">{items}</div>{pager}',
            'columns' => [
                [
                    'class' => 'yii\grid\ActionColumn',
                    'contentOptions' => function ($model, $key, $index, $column) {
                        return ['style' => 'min-width:70px'];
                    }

                ],
                ['class' => 'yii\grid\SerialColumn'],

//            [
//                    'attribute' => 'item_id',
//               'headerOptions' => ['style' => 'width:5%'],
//            ],
                //'supplier_id',
                [
                    'attribute' => 'supplier',
                    'value' => 'supplier.name',
                    'headerOptions' => ['style' => 'min-width:100px'],
                    'label' => Yii::t('app', 'Supplier'),

                ],
                //'item_category_id',
                [
                    'attribute' => 'itemCategory',
                    'value' => 'itemCategory.name',
                    'headerOptions' => ['style' => 'min-width:150px'],
                    'label' => Yii::t('app', 'Category'),

                ],
                [
                    'attribute' => 'supplier_reference',
                    'headerOptions' => ['style' => 'min-width:200px'],
                ],
                [
                    'attribute' => 'name',
                    'headerOptions' => ['style' => 'min-width:300px'],
                ],
                [
                    'attribute' => 'brand',
                    'headerOptions' => ['style' => 'min-width:100px'],
                ],
                [
                    'attribute' => 'model',
                    'headerOptions' => ['style' => 'min-width:200px'],
                ],
                [
                    'attribute' => 'description',
                    'headerOptions' => ['style' => 'min-width:500px'],

                ],
                [
                    'attribute' => 'price',
                    'headerOptions' => ['style' => 'min-width:100px'],
                ],
                [
                    'attribute' => 'comment',
                    'headerOptions' => ['style' => 'min-width:300px'],
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'contentOptions' => function ($model, $key, $index, $column) {
                        return ['style' => 'min-width:70px'];
                    }

                ],
            ],
        ]); ?>
    <?php Pjax::end(); ?>

    <div class="modal remote fade" id="modal-import">
        <div class="modal-dialog">
            <div class="modal-content loader-lg"></div>
        </div>
    </div>
</div>

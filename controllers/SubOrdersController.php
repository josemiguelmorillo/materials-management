<?php

namespace app\controllers;

use app\models\Orders;
use app\models\SubOrderLines;
use app\models\Suppliers;
use Yii;
use app\models\SubOrders;
use app\models\SubOrdersSearch;
use yii\data\ActiveDataProvider;
use yii\db\IntegrityException;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SubOrdersController implements the CRUD actions for SubOrders model.
 */
class SubOrdersController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all SubOrders models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SubOrdersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SubOrders model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new SubOrders model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $dataRequest = \Yii::$app->request->get();
        if (isset($dataRequest['supplier_id'])) {
            /** @var SubOrders $model */
            $model = SubOrders::find()->where(['supplier_id' => $dataRequest['supplier_id']])->one();
            if (empty($model)){
                $model = new SubOrders();
                $model->supplier_id = $dataRequest['supplier_id'];
            }
        } else {
            $model = new SubOrders();
        }

        $suppliers = ArrayHelper::map(Suppliers::find()->all(), 'supplier_id', 'name');
        $orders = ArrayHelper::map(Orders::find()->all(), 'order_id', 'order_id');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_suborder]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'suppliers' => $suppliers,
                'orders' => $orders,
            ]);
        }
    }

    /**
     * Updates an existing SubOrders model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $suppliers = ArrayHelper::map(Suppliers::find()->all(), 'supplier_id', 'name');
        $orders = ArrayHelper::map(Orders::find()->all(), 'order_id', 'order_id');
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_suborder]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'suppliers' => $suppliers,
                'orders' => $orders,
            ]);
        }
    }

    /**
     * Deletes an existing SubOrders model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        try {
            $this->findModel($id)->delete();
        } catch (IntegrityException $e) {
            throw new HttpException(500,\Yii::t('app', 'Cannot delete this item.'), 405);
        }

        return $this->redirect(['index']);
    }

    public function actionAddSupplierItem($id) {
        $subOrder = $this->findModel($id);
        return $this->redirect(['sub-order-lines/create', 'order_id'=>$subOrder->order_id, 'sub_order_id'=> $id]);
    }

    public function actionViewSubOrderDetail()
    {
        $dataRequest = Yii::$app->request->post();
        if (isset($dataRequest)) {
            $subOrderId = $dataRequest['expandRowKey'];
        } else {
            return '';
        }

        $dataProvider = new ActiveDataProvider([
            'query' => SubOrderLines::find()->where(['id_suborder' => $subOrderId]),
        ]);

        return $this->renderPartial('_suborder_detail', ['dataProvider' => $dataProvider, 'key' => $_POST['expandRowKey']]);

    }

    /**
     * Finds the SubOrders model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SubOrders the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SubOrders::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

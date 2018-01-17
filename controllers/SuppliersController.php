<?php

namespace app\controllers;

use app\models\SubOrders;
use Yii;
use app\models\Suppliers;
use app\models\SuppliersSearch;
use yii\db\IntegrityException;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SuppliersController implements the CRUD actions for Suppliers model.
 */
class SuppliersController extends Controller
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
     * Lists all Suppliers models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SuppliersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Suppliers model.
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
     * Creates a new Suppliers model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Suppliers();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->supplier_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Suppliers model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->supplier_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Suppliers model.
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

    public function actionCreateSupplierOrder($id) {
//        /** @var SubOrders $subOrder */
//        $subOrder = SubOrders::find()->where(['supplier_id'=> $id])->one();
//        if (empty($subOrder)) {
//            $subOrder = new SubOrders();
//        }
//        $subOrder->supplier_id = $id;

        return $this->redirect(['sub-orders/create', 'supplier_id'=> $id]);
    }

    /**
     * Finds the Suppliers model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Suppliers the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Suppliers::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

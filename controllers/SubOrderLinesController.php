<?php

namespace app\controllers;

use app\models\Classes;
use app\models\Degrees;
use app\models\Items;
use app\models\LineDetails;
use app\models\Subjects;
use app\models\SubOrderLineForm;
use app\models\SubOrders;
use app\models\Teachers;
use Yii;
use app\models\SubOrderLines;
use app\models\SubOrderLinesSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SubOrderLinesController implements the CRUD actions for SubOrderLines model.
 */
class SubOrderLinesController extends Controller
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
     * Lists all SubOrderLines models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SubOrderLinesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SubOrderLines model.
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
     * Creates a new SubOrderLines model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $subOrderLineForm = new SubOrderLineForm();
        $subOrderLineForm->subOrderLines = new SubOrderLines();

        $dataRequest = \Yii::$app->request->get();
        if (isset($dataRequest['sub_order_id']) && isset($dataRequest['order_id'])) {
            /** @var SubOrders $subOrder */
            $subOrder = SubOrders::find()->where(['order_id' => $dataRequest['order_id'], 'id_suborder' => $dataRequest['sub_order_id']])->one();
            $supplier_id = $subOrder->supplier_id;
            $items = ArrayHelper::map(Items::find()->where(['supplier_id'=> $supplier_id])->all(), 'item_id', 'supplier_reference');
            $subOrderLineForm->subOrderLines->id_suborder = $subOrder->id_suborder;
        } else {
            $items = ArrayHelper::map(Items::find()->all(), 'item_id', 'supplier_reference');
        }
        $degrees = ArrayHelper::map(Degrees::find()->all(), 'degree_id', 'name');
        $teachers = ArrayHelper::map(Teachers::find()->all(), 'teacher_id', 'name');
        $classes = ArrayHelper::map(Classes::find()->all(), 'class_id', 'name');
        $subjects = ArrayHelper::map(Subjects::find()->all(), 'subject_id', 'name');

//        $subOrderLineForm = new SubOrderLineForm();
//        $subOrderLineForm->subOrderLines = new SubOrderLines();
        $subOrderLineForm->lineDetails = new LineDetails();

        if ($subOrderLineForm->subOrderLines->load(Yii::$app->request->post()) && $subOrderLineForm->lineDetails->load(Yii::$app->request->post()) && $subOrderLineForm->save()) {
            return $this->redirect(['view', 'id' => $subOrderLineForm->subOrderLines->suborder_line_id]);
        } else {
            return $this->render('create', [
                'subOrderLineForm' => $subOrderLineForm,
                'items' => $items,
                'degrees' => $degrees,
                'teachers' => $teachers,
                'classes' => $classes,
                'subjects' => $subjects,
            ]);
        }
    }

    /**
     * Updates an existing SubOrderLines model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $subOrderLineForm = new SubOrderLineForm();
        $subOrderLineForm->subOrderLine = $this->findModel($id);
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->suborder_line_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing SubOrderLines model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the SubOrderLines model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SubOrderLines the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SubOrderLines::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

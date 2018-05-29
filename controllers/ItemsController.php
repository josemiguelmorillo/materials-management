<?php

namespace app\controllers;

use app\models\ItemCategories;
use app\models\Suppliers;
use app\models\UploadCatalogForm;
use League\Csv\Reader;
use Throwable;
use Yii;
use app\models\Items;
use app\models\ItemsSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\web\UploadedFile;
use yii\widgets\ActiveForm;

/**
 * ItemsController implements the CRUD actions for Items model.
 */
class ItemsController extends Controller
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
     * Lists all Items models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ItemsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Items model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Items model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Items();
        /** @var Suppliers $suppliers */
        $suppliers = ArrayHelper::map(Suppliers::find()->all(), 'supplier_id', 'name');
        $itemCategories = ArrayHelper::map(ItemCategories::find()->all(), 'item_category_id', 'name');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->item_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'suppliers' => $suppliers,
                'itemCategories' => $itemCategories,
            ]);
        }
    }

    /**
     * Updates an existing Items model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $suppliers = ArrayHelper::map(Suppliers::find()->all(), 'supplier_id', 'name');
        $itemCategories = ArrayHelper::map(ItemCategories::find()->all(), 'item_category_id', 'name');
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->item_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'suppliers' => $suppliers,
                'itemCategories' => $itemCategories,
            ]);
        }
    }

    /**
     * Deletes an existing Items model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws HttpException
     * @throws \Exception
     * @throws Throwable
     */
    public function actionDelete($id)
    {
        try {
            $this->findModel($id)->delete();
        } catch (\Exception $e) {
            Yii::$app->session->addFlash('error', 'Cannot delete this item.');
            return $this->redirect(['view', 'id' => $id]);
            //throw new HttpException(500, \Yii::t('app', 'Cannot delete this item.'), 405);
        }

        return $this->redirect(['index']);
    }

    public function actionShowImportModal()
    {
        Yii::$app->session->removeAllFlashes();
        $model = new UploadCatalogForm();
        $suppliers = ArrayHelper::map(Suppliers::find()->all(), 'supplier_id', 'name');
        $itemCategories = ArrayHelper::map(ItemCategories::find()->all(), 'item_category_id', 'name');
        return $this->renderAjax('_modal_choose_csv_file', [
            'model' => $model,
            'suppliers' => $suppliers,
            'itemCategories' => $itemCategories,
        ]);

    }

    public function actionImport()
    {
        $model = new UploadCatalogForm();

        if ($model->load(Yii::$app->request->post())) {
            $model->catalog_file = UploadedFile::getInstance($model, 'catalog_file');
            if ($model->validate()) {
                $this->importFile($model);
            } else {
                foreach ($model->getFirstErrors() as $error) {
                    Yii::$app->session->addFlash('error', $error);
                }
            }
        }

        return $this->redirect(['index']);

    }

    /**
     * Finds the Items model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Items the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Items::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * @param UploadCatalogForm $model
     * @return bool
     */
    private function importFile($model)
    {
        $result = true;
        $csv = Reader::createFromPath($model->catalog_file->tempName, 'r');
        $csv->setHeaderOffset(0);
        $missing = $this->getMissingHeaders($csv->getHeader());
        if (!empty($missing)) {
            Yii::$app->session->addFlash('error', 'Wrong CSV structure, missing headers [' . json_encode(array_keys($missing)) . ']');
            return false;
        }

        $records = $csv->getRecords();
        foreach ($records as $offset => $record) {
            $item = $this->getItemModel(['supplier_id' => $model->supplier_id, 'item_category_id' => $model->item_category_id, 'supplier_reference' => $record['referencia proveedor']]);


            if ($item->isNewRecord) {
                $item->setAttributes([
                    'supplier_id' => $model->supplier_id,
                    'item_category_id' => $model->item_category_id,
                    'supplier_reference' => $record['referencia proveedor'],
                ]);
            }

            $item->setAttributes([
                'name' => $record['nombre'],
                'brand' => $record['marca'],
                'model' => $record['modelo'],
                'description' => $record['descripcion'],
                'price' => $record['Precio'],
                'discount' => empty($record['descuento']) ? 0 : empty($record['descuento']),
                'units_package' => $record['unidades caja'],
                'catalog_package' => $record['pagina catalogo'],
            ]);
            $result = $item->save();
            if (!$result) {
                foreach ($item->getFirstErrors() as $error) {
                    Yii::$app->session->addFlash('error', $error . 'Check line ' . $offset . '[' . json_encode($record) . ']');
                }

                break;
            }
        }

        if ($result) {
            Yii::$app->session->addFlash('success', 'File uploaded successfully');
        }

        return $result;
    }

    /**
     * @param $whereArray
     * @return Items
     */
    private function getItemModel($whereArray)
    {
        /** @var Items $item */
        $item = Items::find()->where($whereArray)->one();
        if (!isset($item)) {
            $item = new Items();
        }
        return $item;
    }

    /**
     * @param array $header
     * @return array
     */
    private function getMissingHeaders($header)
    {
        $csvSchema = [
            'ID PROVEEDOR',
            'id categoria',
            'referencia proveedor',
            'nombre',
            'marca',
            'modelo',
            'descripcion',
            'Precio',
            'descuento',
            'unidades caja',
            'pagina catalogo',
        ];

        $missing = array_diff_key(array_flip($csvSchema), array_flip($header));

        return $missing;
    }

}

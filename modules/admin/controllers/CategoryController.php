<?php

namespace app\modules\admin\controllers;

use Yii;
use app\helpers\DataProviderHelper;
use app\helpers\FileHelper;
use app\models\category\BrandCategory;
use app\models\category\Category;
use app\models\category\forms\CategoryForm;
use app\models\category\search\CategorySearch;
use app\models\producer\Producer;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['get'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Category models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new CategorySearch();


        $dataProvider = new DataProviderHelper([
            'query' => $searchModel->search($this->request->queryParams),
            'limit' => 10
        ]);

        if (Yii::$app->request->isAjax) {
            $this->layout = false;
            return $this->render('table_data', [
                'dataProvider' => $dataProvider
            ]);
        }

        return $this->render('index', [
            'search' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }


    public function actionSearch()
    {
        $searchModel = new CategorySearch();


        $dataProvider = new DataProviderHelper([
            'query' => $searchModel->search($this->request->queryParams),
            'limit' => 10
        ]);

        if (Yii::$app->request->isAjax) {
            $this->layout = false;
            return $this->render('table_data', [
                'dataProvider' => $dataProvider
            ]);
        }

        return $this->render('index', [
            'search' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * Displays a single Category model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Category model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Category();

        $addForm = new CategoryForm($model);

        $brands = Producer::find()->all();



        $fileUpload = new FileHelper;

        if ($this->request->isPost) {
            if ($addForm->load($this->request->post())) {

                $fileUpload->getInstance([
                    'files' => [
                        'model' =>  $addForm,
                        'property' => 'image',
                    ],
                ]);

                if ($addForm->validate()) {
                    $fileUpload->uploadFile([
                        'files' => [
                            'model' =>  $addForm,
                            'property' => 'image',
                            'uploadedFile' => $addForm->image,
                            'filePath' => $addForm->filePath,
                        ],
                    ]);
                    $record = $addForm->saveRecord();
                    return $this->redirect(['view', 'id' => $record->id]);
                }
            }
        } else {
            $addForm->loadDefaultValues();
        }

        return $this->render('create', [
            'addForm' => $addForm,
            'brands' => $brands
        ]);
    }

    /**
     * Updates an existing Category model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $brands = Producer::find()->all();

        $addForm = new CategoryForm($model);

        $brCat =  BrandCategory::find()->where(['category_id' => $model->id])->all();

        $fileUpload = new FileHelper;

        $oldImage = $addForm->image;

        if ($this->request->isPost) {
            if ($addForm->load($this->request->post())) {

                $fileUpload->getInstance([
                    'files' => [
                        'model' =>  $addForm,
                        'property' => 'image',
                    ],
                ]);
                if ($addForm->validate()) {
                    $fileUpload->uploadFile([
                        'files' => [
                            'model' =>  $addForm,
                            'property' => 'image',
                            'uploadedFile' => $addForm->image,
                            'filePath' => $addForm->filePath,
                            'oldFile' => $oldImage
                        ]
                    ]);
                    $record = $addForm->saveRecord();
                    return $this->redirect(['view', 'id' => $record->id]);
                } else {
                    $addForm->loadDefaultValues();
                }
            }
        }
        return $this->render('update', [
            'addForm' => $addForm,
            'model' => $model,
            'brands' => $brands,
            'brCat' => $brCat,
        ]);
    }

    public function actionDelete($id)
    {

        if ($this->deleteItem($id) === true) {
            return $this->redirect(['index']);
        } else {
            return false;
        }
    }


    public function actionDeleteRow($id)
    {
        if ($this->deleteItem($id) === true) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Deletes an existing Category model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function deleteItem($id)
    {
        $model = $this->findModel($id);

        $file = new FileHelper;

        $file->fileDestroy([
            'files' => [
                'file' => $model->image,
                'filePath' => $model->filePath,
            ],
        ]);

        $model->delete();

        return true;
    }

    /**
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Category::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

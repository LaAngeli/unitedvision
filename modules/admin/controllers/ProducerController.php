<?php

namespace app\modules\admin\controllers;

use Yii;
use app\helpers\DataProviderHelper;
use app\helpers\FileHelper;
use app\models\category\BrandCategory;
use app\models\category\Category;
use app\models\producer\forms\ProducerForm;
use app\models\producer\Producer;
use app\models\producer\search\ProducerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


/**
 * ProducerController implements the CRUD actions for Producer model.
 */
class ProducerController extends Controller
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
     * Lists all Producer models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ProducerSearch();

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
        $searchModel = new ProducerSearch();


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
     * Displays a single Producer model.
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
     * Creates a new Producer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Producer();

        $addForm = new ProducerForm($model);

        $fileUpload = new FileHelper;

        $category = new Category;

        $brandNot = $category->brandNot($model->id);

        $brandCategory = new BrandCategory;

        if ($this->request->isPost) {
            if ($addForm->load($this->request->post())) {
                $fileUpload->getInstance([
                    'files' => [
                        'model' =>  $addForm,
                        'property' => 'image_logo',
                    ],
                    [
                        'model' =>  $addForm,
                        'property' => 'image_brand',
                    ],
                    [
                        'model' =>  $addForm,
                        'property' => 'image_slider_big',
                    ],
                    [
                        'model' =>  $addForm,
                        'property' => 'image_slider_small',
                    ],
                    [
                        'model' =>  $addForm,
                        'property' => 'image_video_preview',
                    ]
                ]);
                if ($addForm->validate()) {
                    $fileUpload->uploadFile([
                        'files' => [
                            'model' =>  $addForm,
                            'property' => 'image_logo',
                            'uploadedFile' => $addForm->image_logo,
                            'filePath' => $addForm->filePath,
                        ],
                        [
                            'model' =>  $addForm,
                            'property' => 'image_brand',
                            'uploadedFile' => $addForm->image_brand,
                            'filePath' => $addForm->filePath,
                        ],
                        [
                            'model' =>  $addForm,
                            'property' => 'image_slider_big',
                            'uploadedFile' => $addForm->image_slider_big,
                            'filePath' => $addForm->filePath,
                        ],
                        [
                            'model' =>  $addForm,
                            'property' => 'image_slider_small',
                            'uploadedFile' => $addForm->image_slider_small,
                            'filePath' => $addForm->filePath,
                        ],
                        [
                            'model' =>  $addForm,
                            'property' => 'image_video_preview',
                            'uploadedFile' => $addForm->image_video_preview,
                            'filePath' => $addForm->filePath,
                        ]
                    ]);

                    $record = $addForm->saveRecord();

                    $brandCategory->saveBrandCategory($addForm->categories, [
                        'producer_id' => $record->id,
                    ]);
                    return $this->redirect(['view', 'id' => $record->id]);
                } else {
                    $addForm->loadDefaultValues();
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
            'addForm' => $addForm,
            'brandNot' => $brandNot
        ]);
    }


    /**
     * Updates an existing Producer model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $category = new Category;

        $addForm = new ProducerForm($model);

        $fileUpload = new FileHelper;

        $brandCategory = new BrandCategory;

        $brandIn =  $category->brandIn($model->id);

        $brandNot = $category->brandNot($model->id);

        $oldLogoFile = $addForm->image_logo;

        $oldBrandFile = $addForm->image_brand;

        $oldSlBigFile = $addForm->image_slider_big;

        $oldSlSmallFile = $addForm->image_slider_small;

        $oldVdPrevFile = $addForm->image_video_preview;

        if ($this->request->isPost) {
            if ($addForm->load($this->request->post())) {

                $fileUpload->getInstance([
                    'files' => [
                        'model' =>  $addForm,
                        'property' => 'image_logo',
                    ],
                    [
                        'model' =>  $addForm,
                        'property' => 'image_brand',
                    ],
                    [
                        'model' =>  $addForm,
                        'property' => 'image_slider_big',
                    ],
                    [
                        'model' =>  $addForm,
                        'property' => 'image_slider_small',
                    ],
                    [
                        'model' =>  $addForm,
                        'property' => 'image_video_preview',
                    ]
                ]);
                if ($addForm->validate()) {

                    $brandCategory->saveBrandCategory($addForm->categories, [
                        'producer_id' => $model->id,
                    ]);
                    $fileUpload->uploadFile([
                        'files' => [
                            'model' =>  $addForm,
                            'property' => 'image_logo',
                            'uploadedFile' => $addForm->image_logo,
                            'filePath' => $addForm->filePath,
                            'oldFile' => $oldLogoFile
                        ],
                        [
                            'model' =>  $addForm,
                            'property' => 'image_brand',
                            'uploadedFile' => $addForm->image_brand,
                            'filePath' => $addForm->filePath,
                            'oldFile' => $oldBrandFile
                        ],
                        [
                            'model' =>  $addForm,
                            'property' => 'image_slider_big',
                            'uploadedFile' => $addForm->image_slider_big,
                            'filePath' => $addForm->filePath,
                            'oldFile' => $oldSlBigFile
                        ],
                        [
                            'model' =>  $addForm,
                            'property' => 'image_slider_small',
                            'uploadedFile' => $addForm->image_slider_small,
                            'filePath' => $addForm->filePath,
                            'oldFile' => $oldSlSmallFile
                        ],
                        [
                            'model' =>  $addForm,
                            'property' => 'image_video_preview',
                            'uploadedFile' => $addForm->image_video_preview,
                            'filePath' => $addForm->filePath,
                            'oldFile' => $oldVdPrevFile
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
            'model' => $model,
            'addForm' => $addForm,
            'brandIn' => $brandIn,
            'brandNot' => $brandNot
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
     * Deletes an existing Producer model.
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
                'file' => $model->image_logo,
                'filePath' => $model->filePath,
            ],
            [

                'file' => $model->image_brand,
                'filePath' => $model->filePath,

            ],
            [

                'file' => $model->image_slider_big,
                'filePath' => $model->filePath,

            ],
            [

                'file' => $model->image_slider_small,
                'filePath' => $model->filePath,

            ],
            [

                'file' => $model->image_video_preview,
                'filePath' => $model->filePath,

            ]
        ]);

        $model->delete();

        return true;
    }

    /**
     * Finds the Producer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Producer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Producer::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

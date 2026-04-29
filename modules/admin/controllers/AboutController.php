<?php

namespace app\modules\admin\controllers;

use Yii;
use app\helpers\DataProviderHelper;
use app\models\pages\forms\AboutForm;
use app\models\pages\About;
use app\models\pages\search\AboutSearch;
use app\helpers\FileHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AboutCorntroller implements the CRUD actions for about model.
 */
class AboutController extends Controller
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

    public function actionIndex()
    {
        $searchModel = new AboutSearch;


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
        $searchModel = new AboutSearch();


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
     * Displays a single about model.
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
     * Creates a new about model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new about();

        $addForm = new AboutForm($model);


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
        ]);
    }

    /**
     * Updates an existing about model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $addForm = new AboutForm($model);

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
     * Deletes an existing MainBanner model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function deleteItem($id)
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
     * Finds the about model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return about the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = about::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

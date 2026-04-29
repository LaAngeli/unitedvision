<?php

namespace app\modules\admin\controllers;

use Yii;
use app\helpers\DataProviderHelper;
use app\helpers\FileHelper;
use app\models\reviews\forms\ReviewsForm;
use app\models\reviews\Reviews;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


/**
 * ReviewsController implements the CRUD actions for Reviews model.
 */
class ReviewsController extends Controller
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
                    'class' => VerbFilter::class,
                    'actions' => [
                        'delete' => ['GET'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Reviews models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new Reviews();

        $dataProvider = new DataProviderHelper([
            'query' => $searchModel::find()->orderBy('updated_at desc'),
            'limit' => 10
        ]);

        if (Yii::$app->request->isAjax) {
            $this->layout = false;
            return $this->render('table_data', [
                'dataProvider' => $dataProvider
            ]);
        }

        return $this->render('index', [
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * Displays a single Reviews model.
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
     * Creates a new Reviews model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Reviews();

        $addForm = new ReviewsForm($model);

        $fileUpload = new FileHelper;

        if ($this->request->isPost) {
            if ($addForm->load($this->request->post())) {
                $fileUpload->getInstance([
                    'files' => [
                        'model' =>  $addForm,
                        'property' => 'image',
                    ]
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
                } else {
                    $addForm->loadDefaultValues();
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
            'addForm' => $addForm,
        ]);
    }


    /**
     * Updates an existing Reviews model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $addForm = new ReviewsForm($model);

        $fileUpload = new FileHelper;

        $oldImg = $addForm->image;

        if ($this->request->isPost) {
            if ($addForm->load($this->request->post())) {

                $fileUpload->getInstance([
                    'files' => [
                        'model' =>  $addForm,
                        'property' => 'image',
                    ]
                ]);
                if ($addForm->validate()) {

                    $fileUpload->uploadFile([
                        'files' => [
                            'model' =>  $addForm,
                            'property' => 'image',
                            'uploadedFile' => $addForm->image,
                            'filePath' => $addForm->filePath,
                            'oldFile' => $oldImg
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
     * Deletes an existing Reviews model.
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
     * Finds the Reviews model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Reviews the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Reviews::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

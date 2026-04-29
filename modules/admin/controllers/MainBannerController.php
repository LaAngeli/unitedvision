<?php

namespace app\modules\admin\controllers;

use Yii;
use app\helpers\DataProviderHelper;
use app\helpers\FileHelper;
use app\models\banner\forms\MainBannerForm;
use app\models\banner\MainBanner;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


/**
 * MainBannerController implements the CRUD actions for MainBanner model.
 */
class MainBannerController extends Controller
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
                        'delete' => ['GET'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all MainBanner models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new MainBanner();

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
     * Displays a single MainBanner model.
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
     * Creates a new MainBanner model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new MainBanner();

        $addForm = new MainBannerForm($model);

        $fileUpload = new FileHelper;

        if ($this->request->isPost) {
            if ($addForm->load($this->request->post())) {
                $fileUpload->getInstance([
                    'files' => [
                        'model' =>  $addForm,
                        'property' => 'image_desktop',
                    ],
                    [
                        'model' =>  $addForm,
                        'property' => 'image_mobile',
                    ],
                ]);
                if ($addForm->validate()) {
                    $fileUpload->uploadFile([
                        'files' => [
                            'model' =>  $addForm,
                            'property' => 'image_desktop',
                            'uploadedFile' => $addForm->image_desktop,
                            'filePath' => $addForm->filePath,
                        ],
                        [
                            'model' =>  $addForm,
                            'property' => 'image_mobile',
                            'uploadedFile' => $addForm->image_mobile,
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
     * Updates an existing MainBanner model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $addForm = new MainBannerForm($model);

        $fileUpload = new FileHelper;

        $oldImgDesktop = $addForm->image_desktop;

        $oldImgMobile = $addForm->image_mobile;


        if ($this->request->isPost) {
            if ($addForm->load($this->request->post())) {

                $fileUpload->getInstance([
                    'files' => [
                        'model' =>  $addForm,
                        'property' => 'image_desktop',
                    ],
                    [
                        'model' =>  $addForm,
                        'property' => 'image_mobile',
                    ]
                ]);
                if ($addForm->validate()) {

                    $fileUpload->uploadFile([
                        'files' => [
                            'model' =>  $addForm,
                            'property' => 'image_desktop',
                            'uploadedFile' => $addForm->image_desktop,
                            'filePath' => $addForm->filePath,
                            'oldFile' => $oldImgDesktop
                        ],
                        [
                            'model' =>  $addForm,
                            'property' => 'image_mobile',
                            'uploadedFile' => $addForm->image_mobile,
                            'filePath' => $addForm->filePath,
                            'oldFile' => $oldImgMobile
                        ],
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
                'file' => $model->image_desktop,
                'filePath' => $model->filePath,
            ],
            [
                'file' => $model->image_mobile,
                'filePath' => $model->filePath,
            ],
        ]);

        $model->delete();

        return true;
    }

    /**
     * Finds the MainBanner model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return MainBanner the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MainBanner::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

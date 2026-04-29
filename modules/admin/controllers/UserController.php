<?php

namespace app\modules\admin\controllers;

use Yii;
use app\helpers\DataProviderHelper;
use app\models\user\forms\RegisterForm;
use app\models\user\forms\UpdateUserForm;
use app\models\user\search\UserSearch;
use app\models\user\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
        $searchModel = new UserSearch;


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
        $searchModel = new UserSearch();


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
     * Displays a single User model.
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
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new User();

        $addForm = new RegisterForm();

        if ($this->request->isPost) {
            if ($addForm->load($this->request->post())) {

                if ($addForm->validate()) {

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
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $updateForm = new UpdateUserForm($model);


        if ($this->request->isPost) {
            if ($updateForm->load($this->request->post())) {


                if ($updateForm->validate()) {

                    $record = $updateForm->saveRecord();
                    return $this->redirect(['view', 'id' => $record->id]);
                } else {
                    $updateForm->loadDefaultValues();
                }
            }
        }
        return $this->render('update', [
            'updateForm' => $updateForm,
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
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function deleteItem($id)
    {
        $model = $this->findModel($id);

        $model->delete();

        return true;
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

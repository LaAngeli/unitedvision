<?php

namespace app\modules\admin\controllers;

use Yii;
use app\helpers\DataProviderHelper;
use app\models\callback\search\CallbackSearch;
use app\models\callback\Callback;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AboutCorntroller implements the CRUD actions for Callback model.
 */
class CallbackController extends Controller
{


    public function actionIndex()
    {
        $searchModel = new CallbackSearch;


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
        $searchModel = new CallbackSearch();


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
     * Displays a single Callback model.
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
     * Updates an existing Callback model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $model->updateCallback();

        if (Yii::$app->request->isAjax) {
            return true;
        } else {
            return $this->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl);
        }
    }



    /**
     * Finds the Callback model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Callback the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Callback::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

<?php

namespace app\controllers;


use app\models\callback\forms\CallbackForm;
use app\models\callback\Callback;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;



class CallbackController extends Controller
{

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionIndex()
    {

        if (Yii::$app->request->isAjax) {

            if (Yii::$app->request->isPost) {

                $model = new Callback;

                $callbackForm = new CallbackForm($model);

                if ($callbackForm->load(Yii::$app->request->post())) {

                    if ($callbackForm->validate()) {

                        $callbackForm->saveRecord();
                    } else {
                        return Yii::$app->response->statusCode = 500;
                    }
                }
            } else {

                throw new NotFoundHttpException('The requested page does not exist.');
            }
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

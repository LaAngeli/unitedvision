<?php

namespace app\controllers;

use app\helpers\DataProviderHelper;
use app\helpers\UrlHelper;
use Yii;
use app\models\services\Services;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;


class ServicesController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

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


        $servicesProvider = new DataProviderHelper([
            'query' => Services::findServices(),
        ]);
        return $this->render(
            'index',
            [
                'servicesProvider' => $servicesProvider->data,
            ]
        );
    }
}

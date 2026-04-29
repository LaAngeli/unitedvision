<?php

namespace app\controllers;

use app\helpers\DataProviderHelper;
use app\helpers\UrlHelper;
use app\models\category\Category;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;


class ProductController extends Controller
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
        $urlCreator = new UrlHelper;
        $categoryProvider = new DataProviderHelper([
            'query' => Category::findProducer(),
            'limit' => 30
        ]);

        return $this->render('index', [
            'categoryProvider' => $categoryProvider->data,
            'urlCreator' => $urlCreator
        ]);
    }
}

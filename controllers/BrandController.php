<?php

namespace app\controllers;

use app\helpers\DataProviderHelper;
use app\helpers\UrlHelper;
use app\models\category\Category;
use app\models\producer\Producer;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;


class BrandController extends Controller
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
        $brandsProvider = new DataProviderHelper([
            'query' => Producer::findProducer(),
        ]);



        return $this->render('index', [
            'brandsProvider' => $brandsProvider->data,
            'urlCreator' => $urlCreator
        ]);
    }

    public function actionDetails($id, $name)
    {
        $urlCreator = new UrlHelper;

        $model = $this->findProducer($id);

        $nameUrl = $urlCreator->createUrl($model->name);

        if ($name !==  $nameUrl) {
            return $this->redirect(['details', 'id' => $model->id, 'name' =>  $nameUrl]);
        }

        $category = new Category;

        $producerCategory =  $category->brandIn($model->id);

        $brandsProvider = new DataProviderHelper([
            'query' => Producer::findProducer(),
            'limit' => 30
        ]);
        return $this->render('details', [
            'model' => $model,
            'urlCreator' => $urlCreator,
            'brandsProvider' => $brandsProvider->data,
            'producerCategory' => $producerCategory
        ]);
    }


    public function actionCategory($category_id, $name)
    {
        $brand = new Producer;

        $category = new Category;

        $urlCreator = new UrlHelper;

        $brandIn = $brand->brandIn($category_id);

        $categoryBrand = $category->findCategoryOne($category_id);

        if ($categoryBrand === null or empty($categoryBrand)) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        $nameUrl = $urlCreator->createUrl($categoryBrand->name);

        if ($name !==  $nameUrl) {
            return $this->redirect(['category', 'category_id' => $category_id, 'name' =>  $nameUrl]);
        }

        $brandsProvider = new DataProviderHelper([
            'query' => $brandIn,
            'limit' => 30
        ]);

        return $this->render('category', [
            'brandsProvider' => $brandsProvider->data,
            'urlCreator' => $urlCreator,
            'categoryBrand' => $categoryBrand
        ]);
    }


    protected function findProducer($id)
    {
        if (($model = Producer::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

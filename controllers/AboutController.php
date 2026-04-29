<?php

namespace app\controllers;

use app\helpers\DataProviderHelper;
use app\models\pages\About;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;


class AboutController extends Controller
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
        $aboutProvider = new DataProviderHelper([
            'query' => About::findAbout(),
            'limit' => 30
        ]);
        return $this->render('index', [
            'aboutProvider' => $aboutProvider->data
        ]);
    }
}

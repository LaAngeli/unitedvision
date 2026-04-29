<?php

namespace app\controllers;

use app\helpers\DataProviderHelper;
use app\helpers\UrlHelper;
use Yii;
use app\models\reviews\Reviews;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;


class ReviewsController extends Controller
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


        $reviewsProvider = new DataProviderHelper([
            'query' => Reviews::findReviews(),
        ]);
        return $this->render(
            'index',
            [
                'reviewsProvider' => $reviewsProvider->data,
            ]
        );
    }
}

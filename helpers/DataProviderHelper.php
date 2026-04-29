<?php

namespace app\helpers;

use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;




class DataProviderHelper
{

    public $model;
    public $query;

    public $page;

    public $limit;

    public $data;

    public $dataCountAll;

    public $dataCountPage;

    public $pagination;

    private $dataAll;

    private $pageParam;

    private $limitParam;


    public function __construct($options)
    {
        $this->query = $options['query'];

        $this->dataAll = $this->query->all();

        $this->dataCountAll = (int) $this->query->count();

        $this->dataCountPage = (int) $this->dataCountAll;

        if (!isset($options['model'])) {

            $this->model = new $this->query->modelClass;
        } else {

            $this->model = $options['model'];
        }

        $this->pageParam = (int) Yii::$app->getRequest()->getQueryParam('page');

        $this->limitParam = (int) Yii::$app->getRequest()->getQueryParam('limit');


        if (!Yii::$app->getRequest()->getQueryParam('page')) {
            $this->page = 1;
        } else {
            $this->page = (int) $this->pageParam;
        }

        if (isset($_GET['page']) and $this->pageParam === 0) {
            return $this->redirectFirstPage();
        }

        if (!isset($options['limit'])) {

            $this->data = $this->dataAll;

            $this->limit = (int) $this->dataCountAll;
        } else {


            if (!Yii::$app->getRequest()->getQueryParam('limit')) {

                $this->limit = (int) $options['limit'];
            } else {

                $this->limit = (int) $this->limitParam;
            }

            if ($this->limit < 1 or $this->limit > $this->dataCountAll) {

                $this->redirectLimit();
            }

            $this->findResult($this->page, $this->limit);

            if (empty($this->data) and $this->pagination > 0  and  (int) $this->page > (int) $this->pagination) {

                return $this->redirectLastPage();
            }
            if (empty($this->data) and $this->page !== 1 or $this->page <= 0) {
                return  $this->redirectFirstPage();
            }
        }
    }


    private function findResult($page, $limit): void
    {
        $this->data = $this->query->limit($limit)->offset(($page - 1) * $limit)->all();

        $this->dataCountPage = count($this->data);

        $this->pagination = ceil($this->query->count() / $limit);
    }

    private function redirectFirstPage(): void
    {
        $this->page = (int) 1;

        Yii::$app->getResponse()->redirect(Url::current(['page' => $this->page]));
    }

    private function redirectLastPage(): void
    {
        $this->page =  $this->pagination;

        Yii::$app->getResponse()->redirect(Url::current(['page' => $this->page]));
    }

    private function redirectLimit(): void
    {

        if ($this->dataCountAll > 0) {
            $this->limit = $this->dataCountAll;
        } else {
            $this->limit = 10;
        }

        // Yii::$app->getResponse()->redirect(Url::current(['limit' => $this->limit]));
    }
}

<?php

namespace app\modules\admin\components;
use Yii;


use yii\base\Widget;

class PaginationWidget extends Widget
{

    public $page;

    public $pagination;


    public $distance = 2;



  public function run()
  {
   
    return $this->render('pagination',
[
    'page' => $this->page,
    'pagination' => $this->pagination,
    'distance' => $this->distance
]);
  }

}

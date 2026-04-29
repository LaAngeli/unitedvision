<?php

namespace app\modules\admin\components;
use Yii;


use yii\base\Widget;

class HeaderWidget extends Widget
{

  

  public function run()
  {
   
    return $this->render('header');
  }

}

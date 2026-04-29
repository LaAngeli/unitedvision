<?php

namespace app\modules\admin\components;
use Yii;


use yii\base\Widget;

class AsideWidget extends Widget
{

  public function run()
  {
   
    return $this->render('aside');
  }

}

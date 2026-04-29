<?php

namespace app\modules\admin\components;

use Yii;


use yii\base\Widget;

class BreadcrumbsWidget extends Widget
{


  public $links;

  public function run()
  {

    return $this->render('breadcrumbs', [
      'links' => $this->links
    ]);
  }
}

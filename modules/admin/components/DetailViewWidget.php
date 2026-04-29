<?php
namespace app\modules\admin\components;



use Yii;
use yii\base\Widget;


class DetailViewWidget extends Widget
{

  public $model;

  public $attributes;

  
  public function run()
  {
    
    return $this->render('detail-view',
     [
      'model' => $this->model,
      'attributes' => $this->attributes,
     ]);
  }
}

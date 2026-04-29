<?php

namespace app\modules\admin\components;



use Yii;
use yii\base\Widget;


class ListViewWidget extends Widget
{


  public $dataProvider;

  public $options = null;

  public $paginationView;

  public $attributes;

  public $buttons;



  public function run()
  {

    return $this->render(
      'list-view',
      [
        'dataProvider' => $this->dataProvider,
        'attributes' => $this->attributes,
        'buttons' => $this->buttons,
        'paginationView' => $this->paginationView,
        'options' => $this->options
      ]
    );
  }
}

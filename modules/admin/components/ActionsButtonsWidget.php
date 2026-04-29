<?php

namespace app\modules\admin\components;

use Yii;


use yii\base\Widget;

class ActionsButtonsWidget extends Widget
{

  public $buttons;




  public function run()
  {

    return $this->render(
      'action-buttons',
      [
        'buttons' => $this->buttons
      ]
    );
  }
}

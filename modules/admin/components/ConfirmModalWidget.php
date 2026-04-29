<?php

namespace app\modules\admin\components;

use Yii;


use yii\base\Widget;

class ConfirmModalWidget extends Widget
{

    public $heading;


    public $heading_icon;

    public $confirmClass;

    public $data_method;
    public function run()
    {

        return $this->render(
            'confirm-modal',
            [
                'heading' => $this->heading,
                'heading_icon' => $this->heading_icon,
                'confirmClass' => $this->confirmClass,
                'data_method' => $this->data_method,
            ]
        );
    }
}

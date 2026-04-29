<?php

namespace app\components;


use app\models\callback\Callback;
use app\models\callback\forms\CallbackForm;
use yii\base\Widget;




class ContactModalWidget extends Widget
{



    public function run()
    {

        $model = new Callback();

        $callbackForm = new CallbackForm($model);


        return $this->render('contact-modal', [
            'callbackForm' => $callbackForm
        ]);
    }
}

<?php

namespace app\helpers;

use Yii;
use yii\helpers\Html;




class TranslateHelper
{



    public function t($options)
    {

        foreach($options as $option){
            if($option['lang'] === Yii::$app->language){
                return $option['value'];
            }
        }
        
    }



    
}
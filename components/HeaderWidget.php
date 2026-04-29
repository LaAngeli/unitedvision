<?php

namespace app\components;

use app\models\site\SiteInfo;
use yii\base\Widget;




class HeaderWidget extends Widget
{

    public $url;

    public function run()
    {

        $siteInfo = SiteInfo::find()->one();

        return $this->render('header', [
            'url' => $this->url,
            'siteInfo' => $siteInfo
        ]);
    }
}

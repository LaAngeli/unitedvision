<?php

namespace app\components;


use app\models\site\SiteInfo;
use yii\base\Widget;




class FooterWidget extends Widget
{

    public $links;
    public $contacts;

    public $text;

    public function run()
    {

        $siteInfo = SiteInfo::find()->one();
        return $this->render('footer', [
            'links' => $this->links,
            'contacts' => $this->contacts,
            'text' => $this->text,
            'siteInfo' => $siteInfo
        ]);
    }
}

<?php

namespace app\helpers;




class UrlHelper
{



    public function createUrl($title)
    {

        $url = $title;

        $url = str_replace(' ', '-', $url);

        $url = preg_replace('/[^A-Za-z0-9\-]/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $url));

        $link = strtolower($url);

        return $link;
    }
}

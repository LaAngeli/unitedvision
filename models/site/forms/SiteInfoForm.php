<?php

namespace app\models\site\forms;

use app\models\site\SiteInfo;
use Yii;

class SiteInfoForm extends SiteInfo
{
    public $model;
    public $site_name;

    public $logo_header;

    public $logo_footer;

    public $footer_text;

    public $site_image;

    public $phone_number;

    public $address;

    public $map_location;

    public $email;

    public $min_description;

    public $max_description;


    public function __construct($model)
    {
        $this->model = $model;

        $this->site_name = $this->model->site_name;

        $this->min_description = $this->model->min_description;

        $this->max_description = $this->model->max_description;

        $this->logo_header = $this->model->logo_header;

        $this->logo_footer = $this->model->logo_footer;

        $this->footer_text = $this->model->footer_text;

        $this->site_image = $this->model->site_image;

        $this->phone_number = $this->model->phone_number;

        $this->address = $this->model->address;

        $this->map_location = $this->model->map_location;

        $this->email = $this->model->email;
    }




    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[
                'site_name', 'min_description',
                'max_description', 'footer_text',
                'address', 'phone_number', 'map_location', 'email'
            ], 'required'],
            [[
                'site_name', 'min_description',
                'max_description', 'footer_text',
                'address', 'phone_number', 'map_location', 'email'
            ], 'trim'],
            [['min_description', 'max_description'], 'string', 'min' => 20, 'max' => 2000],
            [['site_name', 'footer_text', 'address'], 'string', 'min' => 2, 'max' => 255],
            [['map_location'], 'string', 'min' => 1, 'max' => 500],
            [['email'], 'email'],
            [['phone_number'], 'string', 'min' => 6, 'max' => 15],
            [['phone_number'], 'number'],
            [['logo_header', 'logo_footer', 'site_image',], 'file', 'extensions' => 'png, jpg, jpeg, webp, svg, avif'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'site_name' => 'Denumire site',
            'min_description' => 'Descriere scurtă',
            'max_description' => 'Descriere lungă',
            'logo_header' => 'Logo din antetul site-ului',
            'logo_footer' => 'Logo din subsolul site-ului',
            'site_image' => 'Imagine site',
            'footer_text' => 'Text din subsolul site-ului',
            'phone_number' => 'Telefon',
            'address' => 'Adresă',
            'map_location' => 'Locație google maps',
            'email' => 'Email',
        ];
    }

    // Cut special characters and convert them to HTML entities

    public function beforeValidate()
    {
        $this->site_name = htmlspecialchars(strip_tags($this->site_name));
        $this->min_description = htmlspecialchars(strip_tags($this->min_description));
        $this->max_description = htmlspecialchars(strip_tags($this->max_description));
        $this->footer_text = htmlspecialchars(strip_tags($this->footer_text));
        $this->phone_number = htmlspecialchars(strip_tags($this->phone_number));
        $this->address = htmlspecialchars(strip_tags($this->address));
        $this->map_location = htmlspecialchars(strip_tags($this->map_location));
        $this->email = htmlspecialchars(strip_tags($this->email));
        return parent::beforeValidate();
    }


    /**
     * Function tahat saves record in producer table retrun object
     */

    public function saveRecord()
    {
        if ($this->validate()) {
            $this->model->site_name = $this->site_name;
            $this->model->min_description = $this->min_description;
            $this->model->max_description = $this->max_description;
            $this->model->logo_header = $this->logo_header;
            $this->model->logo_footer = $this->logo_footer;
            $this->model->footer_text = $this->footer_text;
            $this->model->site_image = $this->site_image;
            $this->model->phone_number = $this->phone_number;
            $this->model->address = $this->address;
            $this->model->map_location = $this->map_location;
            $this->model->email = $this->email;
            $this->model->updated_at = date('Y-m-d H:i:s');
            $this->model->updated_by = Yii::$app->user->identity->id;

            if ($this->model->save()) {
                return $this->model;
            }
            return false;
        }
        return false;
    }
}

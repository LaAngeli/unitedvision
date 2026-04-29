<?php

namespace app\models\banner\forms;

use app\models\banner\MainBanner;
use Yii;



class MainBannerForm extends MainBanner
{

    public $model;

    public $name;

    public $image_desktop;

    public $image_mobile;

    public $url;

    public $status;


    public function __construct($model)
    {
        $this->model = $model;

        $this->name = $this->model->name;

        $this->image_desktop = $this->model->image_desktop;

        $this->image_mobile = $this->model->image_mobile;

        $this->url = $this->model->url;

        $this->status = $this->model->status;
    }

    public function rules()
    {
        return [
            [['name', 'url', 'status'], 'trim'],
            [['name', 'status'], 'required'],
            [['url'], 'string', 'max' => 500],
            [['status'], 'integer', 'min' => 0, 'max' => 1],
            [['image_desktop', 'image_mobile'], 'file', 'extensions' => 'png, jpg, jpeg, webp, svg, avif'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Denumire',
            'image_desktop' => 'Imagine Desktop',
            'image_mobile' => 'Imagine Mobil',
            'url' => 'Link atașat',
            'status' => 'Statut',
        ];
    }


    public function beforeValidate()
    {
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->url = htmlspecialchars(strip_tags($this->url));
        return parent::beforeValidate();
    }


    /**
     * Function tahat saves record in producer table retrun object
     */

    public function saveRecord()
    {
        if ($this->validate()) {

            $this->model->name = $this->name;
            $this->model->image_desktop = $this->image_desktop;
            $this->model->image_mobile = $this->image_mobile;
            $this->model->url = $this->url;
            $this->model->status = $this->status;

            if ($this->model->save()) {
                return $this->model;
            }
            return false;
        }
        return false;
    }
}

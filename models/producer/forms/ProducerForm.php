<?php

namespace app\models\producer\forms;

use app\models\producer\Producer;
use Yii;

class ProducerForm extends Producer
{
    public $model;
    public $name;

    public $description_min;

    public $description_max;

    public $image_logo;

    public $image_brand;

    public $image_slider_big;

    public $image_slider_small;

    public $image_video_preview;

    public $video_url;

    public $categories;

    public $status;


    public function __construct($model)
    {
        $this->model = $model;

        $this->name = $this->model->name;

        $this->description_min = $this->model->description_min;

        $this->description_max = $this->model->description_max;

        $this->image_logo = $this->model->image_logo;

        $this->image_brand = $this->model->image_brand;

        $this->image_slider_big = $this->model->image_slider_big;

        $this->image_slider_small = $this->model->image_slider_small;

        $this->image_video_preview = $this->model->image_video_preview;

        $this->video_url = $this->model->video_url;

        $this->status = $this->model->status;
    }




    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description_min', 'description_max', 'video_url', 'status'], 'required'],
            [['name', 'description_min', 'description_max', 'video_url', 'status'], 'trim'],
            [['description_min', 'description_max'], 'string', 'min' => 1, 'max' => 5000],
            [['name'], 'string', 'min' => 1, 'max' => 100],
            [['video_url'], 'string', 'min' => 1, 'max' => 500],
            [['image_logo', 'image_brand', 'image_slider_big', 'image_slider_small', 'image_video_preview'], 'file', 'extensions' => 'png, jpg, jpeg, webp, svg, avif'],
            [
                ['name',], 'unique',
                'targetClass' => Producer::class,
                'when' => function ($model, $attribute) {
                    return $model->$attribute !== $this->model->$attribute;
                }
            ],
            [['status'], 'integer', 'min' => 0, 'max' => 1],
            [['categories'], 'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Nume',
            'description_min' => 'Descriere scurtă',
            'description_max' => 'Descriere lungă',
            'image_logo' => 'Imagine logo',
            'image_brand' => 'Imagine brand',
            'image_slider_big' => 'Imagine slider desktop',
            'image_slider_small' => 'Imagine slider mobil',
            'image_video_preview' => 'Imagine previzualizare video',
            'video_url' => 'Link URL youtube',
            'status' => 'Statut',
        ];
    }

    // Cut special characters and convert them to HTML entities

    public function beforeValidate()
    {
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->video_url = htmlspecialchars(strip_tags($this->video_url));
        $this->status = htmlspecialchars(strip_tags($this->status));
        return parent::beforeValidate();
    }


    /**
     * Function tahat saves record in producer table retrun object
     */

    public function saveRecord()
    {
        if ($this->validate()) {
            $this->model->name = $this->name;
            $this->model->description_min = $this->description_min;
            $this->model->description_max = $this->description_max;
            $this->model->image_logo = $this->image_logo;
            $this->model->image_brand = $this->image_brand;
            $this->model->image_slider_big = $this->image_slider_big;
            $this->model->image_slider_small = $this->image_slider_small;
            $this->model->image_video_preview = $this->image_video_preview;
            $this->model->video_url = $this->video_url;
            $this->model->status = $this->status;

            if ($this->model->save()) {
                return $this->model;
            }
            return false;
        }
        return false;
    }
}

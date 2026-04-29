<?php

namespace app\models\reviews\forms;

use app\models\reviews\Reviews;



class ReviewsForm extends Reviews
{
    public $model;
    public $initials;
    public $image;
    public $review;
    public $status;


    public function __construct($model)
    {
        $this->model = $model;

        $this->initials = $this->model->initials;

        $this->image = $this->model->image;

        $this->review = $this->model->review;

        $this->status = $this->model->status;
    }




    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['initials', 'status', 'review'], 'required'],
            [['initials', 'status', 'review'], 'trim'],
            [['review'], 'string', 'min' => 100, 'max' => 5000],
            [['initials'], 'string', 'min' => 1, 'max' => 100],
            [
                ['initials'], 'unique',
                'targetClass' => Reviews::class,
                'when' => function ($model, $attribute) {
                    return $model->$attribute !== $this->model->$attribute;
                }
            ],
            [['image'], 'file', 'extensions' => 'png, jpg, jpeg, webp, svg, avif'],
            [['status'], 'integer', 'min' => 0, 'max' => 1],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'initials' => 'Denumire partener/client',
            'review' => 'Recenzie',
            'image' => 'Imagine',
            'status' => 'Statut',
        ];
    }

    // Cut special characters and convert them to HTML entities

    public function beforeValidate()
    {
        $this->initials = htmlspecialchars(strip_tags($this->initials));
        $this->status = htmlspecialchars(strip_tags($this->status));
        return parent::beforeValidate();
    }


    /**
     * Function tahat saves record in producer table retrun object
     */

    public function saveRecord()
    {
        if ($this->validate()) {

            $this->model->initials = $this->initials;

            $this->model->review = $this->review;

            $this->model->image = $this->image;

            $this->model->status = $this->status;

            if ($this->model->save()) {
                return $this->model;
            }
            return false;
        }
        return false;
    }
}

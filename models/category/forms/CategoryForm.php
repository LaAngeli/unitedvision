<?php

namespace app\models\category\forms;

use app\models\category\Category;


class CategoryForm extends Category
{
    public $model;
    public $name;

    public $description_min;

    public $description_max;

    public $image;

    public $status;


    public function __construct($model)
    {
        $this->model = $model;

        $this->name = $this->model->name;

        $this->description_min = $this->model->description_min;

        $this->description_max = $this->model->description_max;

        $this->image = $this->model->image;

        // $this->producer_id = $this->model->producer_id;

        $this->status = $this->model->status;
    }




    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description_min', 'description_max', 'status'], 'required'],
            [['name', 'description_min', 'description_max', 'status'], 'trim'],
            [['description_min', 'description_max'], 'string', 'min' => 1, 'max' => 5000],
            [['name'], 'string', 'min' => 1, 'max' => 100],
            [['image'], 'file', 'extensions' => 'png, jpg, jpeg, webp, svg, avif'],
            [
                ['name',], 'unique',
                'targetClass' => Category::class,
                'when' => function ($model, $attribute) {
                    return $model->$attribute !== $this->model->$attribute;
                }
            ],
            // [['producer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Producer::class, 'targetAttribute' => ['producer_id' => 'id']],
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
            'name' => 'Nume',
            'description_min' => 'Descriere scurtă',
            'description_max' => 'Descriere lungă',
            'image_logo' => 'Imagine',
            'producer_id' => 'Producător/Brand',
            'status' => 'Statut',
        ];
    }

    // Cut special characters and convert them to HTML entities

    public function beforeValidate()
    {
        $this->name = htmlspecialchars(strip_tags($this->name));
        // $this->producer_id = htmlspecialchars(strip_tags($this->producer_id));
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
            $this->model->image = $this->image;
            // $this->model->producer_id = $this->producer_id;
            $this->model->status = $this->status;

            if ($this->model->save()) {
                return $this->model;
            }
            return false;
        }
        return false;
    }
}

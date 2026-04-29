<?php

namespace app\models\services\forms;

use app\models\services\Services;

/**
 * This is the model class for table "services".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $description_min
 * @property string|null $description_max
 * @property string|null $image
 * @property int|null $status
 * @property string|null $video_url
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property User $createdBy
 * @property User $updatedBy
 */
class ServicesForm extends Services
{
    public $model;
    public $name;

    public $description_min;

    public $description_max;

    public $video_url;

    public $image;

    public $status;


    public function __construct($model)
    {
        $this->model = $model;

        $this->name = $this->model->name;

        $this->description_min = $this->model->description_min;

        $this->description_max = $this->model->description_max;

        $this->image = $this->model->image;

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
            [['image'], 'file', 'extensions' => 'png, jpg, jpeg, webp, svg, avif'],
            [
                ['name',], 'unique',
                'targetClass' => Services::class,
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
            'image' => 'Imagine',
            'video_url' => 'Video YouTube URL',
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
            $this->model->image = $this->image;
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

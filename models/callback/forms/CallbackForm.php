<?php

namespace app\models\callback\forms;

use app\models\callback\Callback;
use Yii;
use app\models\User;


class CallbackForm extends Callback
{

    public $model;

    public $initials;

    public $email;

    public $phone;

    public $notice;


    public function __construct($model)
    {
        $this->model = $model;

        $this->initials = $this->model->initials;

        $this->email = $this->model->email;

        $this->phone = $this->model->phone;

        $this->notice = $this->model->notice;
    }

    public function rules()
    {
        return [
            [['initials', 'email', 'phone', 'notice'], 'trim'],
            [['initials', 'email', 'phone'], 'required'],
            [['initials'], 'string', 'min' => 2, 'max' => 50],
            [['notice'], 'string', 'min' => 10, 'max' => 500],
            [['email'], 'email'],
            [['phone'], 'string', 'min' => 6, 'max' => 15],
            [['phone'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'initials' => 'Nume/Prenume',
            'email' => 'Email',
            'notice' => 'Mesaj',
            'phone' => 'Telefon',
        ];
    }


    public function beforeValidate()
    {
        $this->initials = htmlspecialchars(strip_tags($this->initials));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->phone = htmlspecialchars(strip_tags($this->phone));
        $this->notice = htmlspecialchars(strip_tags($this->notice));
        return parent::beforeValidate();
    }


    /**
     * Function tahat saves record in producer table retrun object
     */

    public function saveRecord()
    {
        if ($this->validate()) {

            $this->model->initials = $this->initials;
            $this->model->email = $this->email;
            $this->model->phone = $this->phone;
            $this->model->notice = $this->notice;
            $this->model->status = $this->model::INACTIVE;

            if ($this->model->save()) {
                $this->model->callbackEmail($this->model);
                return $this->model;
            }
            return false;
        }
        return false;
    }
}

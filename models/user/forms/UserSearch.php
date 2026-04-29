<?php

namespace app\models\user\forms;

use Yii;


use app\models\user\User;



class UserSearch extends User
{

    public $id;
    public $firstname;

    public $lastname;

    public $user_code;

    public $status;

    public $phone;

    public $email;

    public $country;

    public $city;

    public $address;

    public $role;

    public $gender;



    public function rules()
    {
        return [
            [['id', 'firstname', 'lastname', 'user_code', 'status', 'email', 'country', 'city', 'address', 'gender', 'phone', 'role'], 'trim'],
            [['id', 'gender', 'status'], 'integer'],
            [['email'], 'email']
        ];
    }


    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'booking_code' => 'Cod Rezervare',
            'tour_code' => 'Cod Tur',
            'tour_id' => 'ID Tur',
            'payment_id' => 'ID Plată',
            'email' => 'Adresa email',
            'phone' => 'Telefon',
            'status' => 'Statut',
            'address' => 'Hotel sau adresa',
            'total_members' => 'Număr de membri',
            'departure' => 'Timpul Plecării',
            'return' => 'Timpul Returnării'
        ];
    }

    public function search($params)
    {
        $query = User::find()->orderBy('updated_at desc');

        // add conditions that should always apply here


        $this->load($params);

        if ($this->validate()) {





            $query->join('LEFT JOIN', 'auth_assignment', 'auth_assignment.user_id = id')
                ->andFilterWhere(['auth_assignment.item_name' => $this->role]);

            $query->join('LEFT JOIN', 'user_info', 'user_info.user_id = user.id')
                ->andFilterWhere(['user_info.country' => $this->country])
                ->andFilterWhere(['user_info.phone' => $this->phone])
                ->andFilterWhere(['user_info.city' => $this->city])
                ->andFilterWhere(['user_info.address' => $this->address])
                ->andFilterWhere(['user_info.gender' => $this->gender]);


            $query->andFilterWhere(['user_code' => $this->user_code])
                ->andFilterWhere(['id' => $this->id])
                ->andFilterWhere(['email' => $this->email])
                ->andFilterWhere(['firstname' => $this->firstname])
                ->andFilterWhere(['lastname' => $this->lastname])
                ->andFilterWhere(['status' => $this->status]);

            return $query;
        }
        return false;
    }
}

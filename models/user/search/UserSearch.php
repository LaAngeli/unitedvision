<?php

namespace app\models\user\search;

// use yii\base\Model;

use app\models\user\User;

/**
 * UserSearch represents the model behind the search form of `app\models\user\User`.
 */
class UserSearch extends User
{

    public $email;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email'], 'string'],
        ];
    }


    public function formName()
    {
        return '';
    }



    public function search($params)
    {
        $query = User::find()->orderBy('updated_at desc');

        // add conditions that should always apply here


        $this->load($params);

        if ($this->validate()) {

            $query->andFilterWhere(['like', 'email',  $this->email]);

            return $query;
        }
        return false;
    }
}

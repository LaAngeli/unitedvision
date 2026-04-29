<?php

namespace app\models\services\search;

// use yii\base\Model;

use app\models\services\Services;

/**
 * ServicesSearch represents the model behind the search form of `app\models\services\Services`.
 */
class ServicesSearch extends Services
{

    public $name;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string'],
        ];
    }

    public function formName()
    {
        return '';
    }


    public function search($params)
    {
        $query = Services::find()->orderBy('updated_at desc');

        // add conditions that should always apply here


        $this->load($params);

        if ($this->validate()) {

            $query->andFilterWhere(['like', 'name',  $this->name]);

            return $query;
        }
        return false;
    }
}

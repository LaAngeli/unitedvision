<?php

namespace app\models\producer\search;

// use yii\base\Model;

use app\models\producer\Producer;

/**
 * ProducerSearch represents the model behind the search form of `app\models\producer\Producer`.
 */
class ProducerSearch extends Producer
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
        $query = Producer::find()->orderBy('updated_at desc');

        // add conditions that should always apply here


        $this->load($params);

        if ($this->validate()) {

            $query->andFilterWhere(['like', 'name',  $this->name]);

            return $query;
        }
        return false;
    }
}

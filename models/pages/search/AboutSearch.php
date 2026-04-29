<?php

namespace app\models\pages\search;

// use yii\base\Model;

use app\models\pages\About;

/**
 * AboutSearch represents the model behind the search form of `app\models\pages\About`.
 */
class AboutSearch extends About
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
        $query = About::find()->orderBy('updated_at desc');

        // add conditions that should always apply here


        $this->load($params);

        if ($this->validate()) {

            $query->andFilterWhere(['like', 'name',  $this->name]);

            return $query;
        }
        return false;
    }
}

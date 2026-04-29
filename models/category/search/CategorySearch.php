<?php

namespace app\models\category\search;

use yii\data\ActiveDataProvider;
use app\models\category\Category;

/**
 * CategorySearch represents the model behind the search form of `app\models\category\Category`.
 */
class CategorySearch extends Category
{
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

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Category::find()->orderBy('updated_at desc');

        // add conditions that should always apply here


        $this->load($params);

        if ($this->validate()) {

            $query->andFilterWhere(['like', 'name',  $this->name]);

            return $query;
        }
        return false;
    }
}

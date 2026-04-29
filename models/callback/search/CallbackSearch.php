<?php

namespace app\models\callback\search;


use yii\data\ActiveDataProvider;
use app\models\callback\Callback;

/**
 * CallbackSearch represents the model behind the search form of `app\models\callback\Callback`.
 */
class CallbackSearch extends Callback
{

    public $limit;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [

            [['initials', 'limit'], 'string'],
            [['initials', 'limit'], 'trim'],
        ];
    }

    public function formName()
    {
        return '';
    }


    public function beforeValidate()
    {

        $this->limit = htmlspecialchars(strip_tags(preg_replace("/[^0-9.]/", "", $this->limit)));

        return parent::beforeValidate();
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
        $query = Callback::find()->orderBy('created_at desc');

        // add conditions that should always apply here


        $this->load($params);

        if ($this->validate()) {

            $query->andFilterWhere(['like', 'initials',  $this->initials]);

            return $query;
        }
        return false;
    }
}

<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\city;

/**
 * citySeacrh represents the model behind the search form about `app\models\city`.
 */
class citySeacrh extends city
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'province_id'], 'integer'],
            [['city_code', 'city_description', 'citycol'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
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
        $query = city::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'province_id' => $this->province_id,
        ]);

        $query->andFilterWhere(['like', 'city_code', $this->city_code])
            ->andFilterWhere(['like', 'city_description', $this->city_description])
            ->andFilterWhere(['like', 'citycol', $this->citycol]);

        return $dataProvider;
    }
}

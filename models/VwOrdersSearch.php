<?php
/**
 * Created by PhpStorm.
 * User: josemiguelmorillocallejon
 * Date: 19/01/18
 * Time: 05:26
 */

namespace app\models;


use yii\base\Model;
use yii\data\ActiveDataProvider;

class VwOrdersSearch extends VwOrders
{
    public function rules()
    {
        return [
            [['order_id'], 'integer'],
            [['value_date', 'academic_year'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = VwOrders::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'order_id' => $this->order_id,
            'value_date' => $this->value_date,
        ]);

        $query->andFilterWhere(['like', 'academic_year', $this->academic_year]);

        return $dataProvider;
    }

}
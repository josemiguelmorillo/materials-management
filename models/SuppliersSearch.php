<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Suppliers;

/**
 * SuppliersSearch represents the model behind the search form about `app\models\Suppliers`.
 */
class SuppliersSearch extends Suppliers
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['supplier_id'], 'integer'],
            [['name', 'legal_name', 'cif', 'address', 'phone_number', 'contact_name', 'contact_phone', 'www', 'email'], 'safe'],
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
        $query = Suppliers::find();

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
            'supplier_id' => $this->supplier_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'legal_name', $this->legal_name])
            ->andFilterWhere(['like', 'cif', $this->cif])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'phone_number', $this->phone_number])
            ->andFilterWhere(['like', 'contact_name', $this->contact_name])
            ->andFilterWhere(['like', 'contact_phone', $this->contact_phone])
            ->andFilterWhere(['like', 'www', $this->www])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}

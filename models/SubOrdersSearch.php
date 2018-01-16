<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SubOrders;

/**
 * SubOrdersSearch represents the model behind the search form about `app\models\SubOrders`.
 */
class SubOrdersSearch extends SubOrders
{
    public $supplier;
    public $order;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['supplier', 'order'], 'safe'],
            [['id_suborder', 'order_id', 'supplier_id'], 'integer'],
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
        $query = SubOrders::find();
        $query->joinWith(['supplier', 'order']);

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
            'id_suborder' => $this->id_suborder,
            'order_id' => $this->order_id,
            'supplier_id' => $this->supplier_id,
        ]);

        $query->andFilterWhere(['like', 'Suppliers.name', $this->supplier])
            ->andFilterWhere(['Orders.order_id'=> $this->order]);

        return $dataProvider;
    }
}

<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Items;

/**
 * ItemsSearch represents the model behind the search form about `app\models\Items`.
 */
class ItemsSearch extends Items
{
    public $supplier;
    public $itemCategory;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['supplier', 'itemCategory'], 'safe'],
            [['item_id', 'supplier_id', 'item_category_id'], 'integer'],
            [['supplier_reference', 'name', 'brand', 'model', 'description', 'comment'], 'safe'],
            [['price'], 'number'],
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
        $query = Items::find();
        $query->joinWith(['supplier', 'itemCategory']);

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
            'item_id' => $this->item_id,
            'supplier_id' => $this->supplier_id,
            'item_category_id' => $this->item_category_id,
            'price' => $this->price,
        ]);

        $query->andFilterWhere(['like', 'supplier_reference', $this->supplier_reference])
            ->andFilterWhere(['like', 'Items.name', $this->name])
            ->andFilterWhere(['like', 'brand', $this->brand])
            ->andFilterWhere(['like', 'model', $this->model])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'comment', $this->comment])
            ->andFilterWhere(['like', 'Suppliers.name', $this->supplier])
            ->andFilterWhere(['like', 'ItemCategories.name', $this->itemCategory]);

        return $dataProvider;
    }
}

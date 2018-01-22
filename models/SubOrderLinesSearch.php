<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SubOrderLines;

/**
 * SubOrderLinesSearch represents the model behind the search form about `app\models\SubOrderLines`.
 */
class SubOrderLinesSearch extends SubOrderLines
{
    public $item;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item'], 'safe'],
            [['suborder_line_id', 'id_suborder', 'item_id', 'unit', 'line_detail_id'], 'integer'],
            [['unit_price', 'discount'], 'number'],
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
        $query = SubOrderLines::find();
        $query->joinWith('item');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'suborder_line_id' => $this->suborder_line_id,
            'id_suborder' => $this->id_suborder,
            'item_id' => $this->item_id,
            'unit' => $this->unit,
            'unit_price' => $this->unit_price,
            'discount' => $this->discount,
            'line_detail_id' => $this->line_detail_id,
        ]);

        $query->andFilterWhere(['like', 'Items.supplier_reference', $this->item]);

        return $dataProvider;
    }
}

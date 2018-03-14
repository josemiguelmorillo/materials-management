<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\VwTeachersConsumption;

/**
 * VwTeachersConsumptionSearch represents the model behind the search form of `app\models\VwTeachersConsumption`.
 */
class VwTeachersConsumptionSearch extends VwTeachersConsumption
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['teacher_id', 'order_id', 'id_suborder', 'item_id'], 'integer'],
            [['teacher_name', 'item_name'], 'safe'],
            [['unit_price', 'discount', 'units'], 'number'],
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
        $query = VwTeachersConsumption::find();

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
            'teacher_id' => $this->teacher_id,
            'order_id' => $this->order_id,
            'id_suborder' => $this->id_suborder,
            'item_id' => $this->item_id,
            'unit_price' => $this->unit_price,
            'discount' => $this->discount,
            'units' => $this->units,
        ]);

        $query->andFilterWhere(['like', 'teacher_name', $this->teacher_name])
            ->andFilterWhere(['like', 'item_name', $this->item_name]);

        return $dataProvider;
    }
}

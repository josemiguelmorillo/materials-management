<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\LineDetails;

/**
 * LineDetailsSearch represents the model behind the search form about `app\models\LineDetails`.
 */
class LineDetailsSearch extends LineDetails
{
    public $degree;
    public $teacher;
    public $class;
    public $subject;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['line_detail_id', 'degree_id', 'teacher_id', 'class_id', 'subject_id'], 'integer'],
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
        $query = LineDetails::find();
        $query->joinWith(['degree', 'teacher', 'class', 'subject']);

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
            'line_detail_id' => $this->line_detail_id,
            'degree_id' => $this->degree_id,
            'teacher_id' => $this->teacher_id,
            'class_id' => $this->class_id,
            'subject_id' => $this->subject_id,
        ]);

        $query->andFilterWhere(['like', 'Degrees.name', $this->degree])
            ->andFilterWhere(['like', 'Teachers.name', $this->teacher])
            ->andFilterWhere(['like', 'Classes.name', $this->class])
            ->andFilterWhere(['like', 'Subjects.name', $this->subject]);

        return $dataProvider;
    }
}

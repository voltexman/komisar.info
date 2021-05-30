<?php


namespace backend\models;


use yii\data\ActiveDataProvider;

class SearchArticle extends Article
{
    public $from_date;
    public $to_date;

    public function rules(): array
    {
        return [
            [['name'], 'string'],
            [['publication', 'indexation'], 'boolean'],
            [['from_date', 'to_date'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Article::scenarios();
    }

    public function search($params)
    {
        $query = Article::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 20],
            'sort' => ['defaultOrder' => ['id' => SORT_DESC]]
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'publication' => $this->publication,
            'indexation' => $this->indexation
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
        ->andFilterWhere([
            'and',
            ['>', 'created_at', $this->from_date],
            ['<', 'created_at', $this->to_date]
        ]);

        return $dataProvider;

    }
}
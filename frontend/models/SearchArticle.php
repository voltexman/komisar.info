<?php

namespace frontend\models;


use backend\models\Article;
use yii\data\ActiveDataProvider;

/**
 * This is the search model class for table "articles".
 *
 * @property int $id
 * @property string $searchString
 */
class SearchArticle extends Article
{
    /**
     * @var
     */
    public $searchString;

    public function rules(): array
    {
        return [
            [['searchString'], 'string'],
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
            'query' => $query
                ->where(['publication' => Article::PUBLICATION_ON]),
            'sort' => ['defaultOrder' => ['id' => SORT_DESC]],
            'pagination' => [
                'pageSize' => 9
            ]
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'publication' => Article::PUBLICATION_ON,
        ]);

        $query->andFilterWhere([
            'or',
            ['like', 'name', $this->searchString],
            ['like', 'text', $this->searchString],
            ['like', 'tags', $this->searchString]
        ]);

        return $dataProvider;
    }
}
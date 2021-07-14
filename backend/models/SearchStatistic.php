<?php

namespace backend\models;

use blog\helpers\StatisticsHelper;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Statistics;

/**
 * SearchStatistic represents the model behind the search form of `common\models\Statistics`.
 */
class SearchStatistic extends Statistics
{
    public $from_date;
    public $to_date;
    
    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['id', 'status'], 'integer'],
            [['ip', 'browser', 'device', 'os', 'visited_at', 'latitude', 'longitude', 'accuracy', 'from_date', 'to_date'], 'safe'],
        ];
    }
    
    public function attributeLabels(): array
    {
        return [
            'os' => 'Операционная система',
            'browser' => 'Браузер',
            'device' => 'Устройство',
            'returns' => 'Посещений',
            'transitions' => 'Переходов'
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Statistics::find()
            ->where(['status' => Statistics::STATUS_REAL]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'visited_at' => SORT_DESC
                ]],
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'visited_at' => $this->visited_at,
        ]);

        $query->andFilterWhere(['like', 'ip', $this->ip])
            ->andFilterWhere(['like', 'browser', $this->browser])
            ->andFilterWhere(['like', 'device', $this->device])
            ->andFilterWhere(['like', 'os', $this->os])
            ->andFilterWhere(['like', 'latitude', $this->latitude])
            ->andFilterWhere(['like', 'longitude', $this->longitude])
            ->andFilterWhere(['like', 'accuracy', $this->accuracy])

            ->andFilterWhere(['>=', 'visited_at', $this->from_date])
            ->andFilterWhere(['<=', 'visited_at', $this->to_date]);

        return $dataProvider;
    }
}

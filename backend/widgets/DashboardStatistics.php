<?php


namespace backend\widgets;


use common\models\Statistics;
use yii\base\Widget;
use yii\data\ActiveDataProvider;

class DashboardStatistics extends Widget
{
    public function run(): string
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Statistics::find()
                ->where(['type' => Statistics::HUMAN])
                ->andWhere(['real_guest' => Statistics::REAL_GUEST]),
            'sort' => [
                'defaultOrder' => [
                    'visited_at' => SORT_DESC
                ]],
            'pagination' => [
                'pageSize' => 5,
            ],
        ]);

        return $this->render('dashboard-statistics', ['dataProvider' => $dataProvider]);
    }
}
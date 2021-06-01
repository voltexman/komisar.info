<?php


namespace backend\widgets;


use common\models\Statistics;
use yii\base\Widget;
use yii\data\ActiveDataProvider;

class DashboardStatistics extends Widget
{
    public function run()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Statistics::find()
                ->where(['type' => Statistics::HUMAN]),
            'sort' => [
                'defaultOrder' => [
                    'visited_at' => SORT_DESC
                ]],
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('dashboard-statistics', ['dataProvider' => $dataProvider]);
    }
}
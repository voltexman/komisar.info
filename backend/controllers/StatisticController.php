<?php


namespace backend\controllers;


use common\models\Statistics;
use yii\web\Controller;

class StatisticController extends Controller
{
    public function actionStatisticsDetails($id): string
    {
        $statistics = Statistics::findOne($id);
        $pages = $statistics->getPages()
            ->where(['real_page' => Statistics::REAL_PAGE])->all();

        return $this->renderAjax('statistics-details', [
            'statistics' => $statistics,
            'pages' => $pages
        ]);
    }
}
<?php


namespace backend\controllers;


use backend\models\SearchStatistic;
use blog\helpers\StatisticsHelper;
use common\models\Statistics;
use Sinergi\BrowserDetector\Os;
use Yii;
use yii\base\BaseObject;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class StatisticController extends Controller
{
    public function actionDetails($id): string
    {
        $statistics = Statistics::findOne($id);

        return $this->renderAjax('details', [
            'statistics' => $statistics
        ]);
    }

    public function actionCharts(): string
    {
        $devices = [];
        $os = [];

        $devices['desktops'] = StatisticsHelper::getDesktopsCount();
        $devices['mobiles'] = StatisticsHelper::getMobilesCount();

        $os[Os::ANDROID] = StatisticsHelper::getAndroidCount();
        $os[Os::WINDOWS] = StatisticsHelper::getWindowsCount();
        $os[Os::LINUX] = StatisticsHelper::getLinuxCount();
        $os[Os::IOS] = StatisticsHelper::getIosCount();

        return $this->renderAjax('charts', [
            'devices' => $devices,
            'os' => $os
        ]);
    }

    public function actionIndex(): string
    {
        $searchModel = new SearchStatistic();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }
}
<?php


namespace backend\widgets;


use blog\helpers\StatisticsHelper;
use yii\base\Widget;

class DashboardDevicesStatisticsPie extends Widget
{
    public function run()
    {
        $devices = [];

        $devices['desktops'] = StatisticsHelper::getDesktopsCount();
        $devices['mobiles'] = StatisticsHelper::getMobilesCount();

        return $this->render('dashboard-devices-statistics-pie', ['devices' => $devices]);
    }
}
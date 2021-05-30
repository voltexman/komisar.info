<?php


namespace blog\helpers;


use common\models\Statistics;

class StatisticsHelper
{
    public static function getDesktopsCount(): int
    {
        return Statistics::find()
            ->where(['device' => Statistics::DESKTOP])
            ->andWhere(['type' => Statistics::HUMAN])
            ->count();
    }

    public static function getMobilesCount(): int
    {
        return Statistics::find()
            ->where(['device' => Statistics::MOBILE])
            ->andWhere(['type' => Statistics::HUMAN])
            ->count();
    }

    public static function getTotalVisitorsCount(): int
    {
        return Statistics::find()
            ->where(['type' => Statistics::HUMAN])
            ->count();
    }

    public static function getTotalBotsCount(): int
    {
        return Statistics::find()
            ->where(['type' => Statistics::BOT])
            ->count();
    }
}
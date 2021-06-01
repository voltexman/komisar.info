<?php


namespace blog\helpers;


use common\models\Statistics;
use Yii;

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

    public static function getRealName($name): string
    {
        return match ($name) {
            '/' => 'Главная страница',
            '/favorite' => 'Избранное',
            '/contact' => 'Контакты',
            default => $name
        };
    }

    public static function getRealPageStatus($alias): bool
    {
        $isArticle = ArticleHelper::getPageNameByAlias($alias);
        $otherPages = ['', 'favorite', 'contact'];
        $isOtherPage = in_array($alias, $otherPages);

        return $isArticle || $isOtherPage ? Statistics::REAL_PAGE : Statistics::NOT_REAP_PAGE;
    }

    public static function isTodayDate($visited_at): bool
    {
        $nowDate = Yii::$app->formatter->asDate('now', 'php:Y-m-d');
        $visitedDate = Yii::$app->formatter->asDate($visited_at, 'php:Y-m-d');

        return $nowDate === $visitedDate;
    }

    public static function getStatisticsIcon(string $data): string
    {
        return match ($data) {
            'Windows' => '<i class="fa fa-windows"></i> ',
            'OS X' => '<i class="fa fa-apple"></i> ',
            'iOS' => '<i class="fa fa-apple"></i> ',
            'Linux' => '<i class="fa fa-linux"></i> ',
            'Android' => '<i class="fa fa-android"></i> ',
            'Chrome' => '<i class="fa fa-chrome"></i> ',
            'Safari' => '<i class="fa fa-safari"></i> ',
            'Firefox' => '<i class="fa fa-firefox"></i> ',

            default => ''
        };
    }
}
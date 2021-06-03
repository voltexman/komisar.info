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

    public static function isRealRequest($alias): bool
    {
        $isArticle = ArticleHelper::getPageNameByAlias($alias);
        $otherPages = ['', 'favorite', 'contact'];
        $isOtherPage = in_array($alias, $otherPages);

        return $isArticle || $isOtherPage;
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
            'Internet Explorer' => '<i class="fa fa-internet-explorer"></i> ',

            default => ''
        };
    }

    public static function getVisitedPagesCount(int $id): int
    {
        return Statistics::findOne($id)
            ->getPages()
    ->count();
}

public static function getCityByIp($ip): string
{
//        $server1 = @json_decode(file_get_contents('http://www.geoplugin.net/json.gp?ip=' . $ip));

//        $server1->geoplugin_city

    $server2 = curl_init('http://ip-api.com/json/' . $ip . '?lang=ru');
    curl_setopt($server2, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($server2, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($server2, CURLOPT_HEADER, false);
    $res = curl_exec($server2);
    curl_close($server2);

    $server2 = json_decode($res, true);

    return $server2['city'];
}

public static function getCountryByIp($ip): string
{
    $ip_data = @json_decode(file_get_contents('http://www.geoplugin.net/json.gp?ip=' . $ip));

    return $ip_data->geoplugin_countryName;
}

public static function getTodayVisitedCount(): int
{
    return Statistics::find()
        ->where(['like', 'visited_at', date('Y-m-d')])
        ->andWhere(['type' => Statistics::HUMAN])
        ->count();
}
}
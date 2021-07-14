<?php


namespace blog\helpers;


use blog\components\geoip\Geoip;
use common\models\Statistics;
use Sinergi\BrowserDetector\Os;
use Yii;
use yii\helpers\ArrayHelper;

class StatisticsHelper
{
    public static function getDesktopsCount(): int
    {
        return Statistics::find()
            ->where(['device' => Statistics::DESKTOP])
            ->andWhere(['status' => Statistics::STATUS_REAL])
            ->count();
    }

    public static function getMobilesCount(): int
    {
        return Statistics::find()
            ->where(['device' => Statistics::MOBILE])
            ->andWhere(['status' => Statistics::STATUS_REAL])
            ->count();
    }

    public static function getAndroidCount(): int
    {
        return Statistics::find()
            ->where(['device' => Os::ANDROID])
            ->andWhere(['status' => Statistics::STATUS_REAL])
            ->count();
    }

    public static function getWindowsCount(): int
    {
        return Statistics::find()
            ->where(['device' => Os::WINDOWS])
            ->andWhere(['status' => Statistics::STATUS_REAL])
            ->count();
    }

    public static function getLinuxCount(): int
    {
        return Statistics::find()
            ->where(['device' => Os::LINUX])
            ->andWhere(['status' => Statistics::STATUS_REAL])
            ->count();
    }

    public static function getIosCount(): int
    {
        return Statistics::find()
            ->where(['device' => Os::IOS])
            ->andWhere(['status' => Statistics::STATUS_REAL])
            ->count();
    }

    public static function getTotalVisitorsCount(): int
    {
        return Statistics::find()
            ->where(['status' => Statistics::STATUS_REAL])
            ->count();
    }

    public static function getTotalBotsCount(): int
    {
        return Statistics::find()
            ->where(['status' => Statistics::STATUS_BOT])
            ->count();
    }

    public static function getTotalUnknownCount(): int
    {
        return Statistics::find()
            ->where(['status' => Statistics::STATUS_UNKNOWN])
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
            Statistics::DESKTOP => '<i class="fa fa-desktop"></i> ',
            Statistics::MOBILE => '<i class="fa fa-mobile"></i> ',

            default => ''
        };
    }

    public static function getVisitedPagesCount(int $id): int
    {
        return Statistics::findOne($id)
            ->getPages()
            ->count();
    }

    public static function getOsList(): array
    {
        $array = Statistics::find()
            ->where(['status' => Statistics::STATUS_REAL])
            ->select('os')
            ->asArray()
            ->column();

        $uniqueArray = array_unique($array);

        return array_combine($uniqueArray, $uniqueArray);
    }

    public static function getBrowserList(): array
    {
        $array = Statistics::find()
            ->where(['status' => Statistics::STATUS_REAL])
            ->select('browser')
            ->asArray()
            ->column();

        $uniqueArray = array_unique($array);

        return array_combine($uniqueArray, $uniqueArray);
    }

    public static function getDeviceList(): array
    {
        return [
            'mobile' => 'Мобильные',
            'desktop' => 'Компьютеры'
        ];
    }

    public static function maxReturns(): int
    {
        return 200;
    }

    public static function maxTransitions(): int
    {
        return 200;
    }

    public static function getCityByIp($ip): string
    {
//        $server1 = @json_decode(file_get_contents('http://www.geoplugin.net/json.gp?ip=' . $ip));

//        $server1->geoplugin_city

//        $server2 = curl_init('http://ip-api.com/json/' . $ip . '?lang=ru');
//        curl_setopt($server2, CURLOPT_RETURNTRANSFER, true);
//        curl_setopt($server2, CURLOPT_SSL_VERIFYPEER, false);
//        curl_setopt($server2, CURLOPT_HEADER, false);
//        $res = curl_exec($server2);
//        curl_close($server2);
//
//        $server2 = json_decode($res, true);

//        return $server2['city'];

        $geo = new Geoip();

        // get by remote IP
        $geo->get($ip);
        return isset($geo->city['name_ru']) && !empty($geo->city['name_ru']) ? $geo->city['name_ru'] : self::reserveServerCityByIp($ip);
    }

    protected static function reserveServerCityByIp($ip): string
    {
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

    public static function hasCoordinates($id): bool
    {
        $statistic = Statistics::findOne($id);

        return $statistic->latitude && $statistic->longitude;
    }

    public static function getColorMarker($id): string
    {
        $color = '';

        self::hasCoordinates($id) ? $color = 'text-success' : null;

        return '<i class="' . $color . ' fa fa-map-marker"></i> ';
    }

    public static function getTodayVisitedCount(): int
    {
        return Statistics::find()
            ->where(['like', 'visited_at', date('Y-m-d')])
            ->andWhere(['status' => Statistics::STATUS_REAL])
            ->count();
    }
}
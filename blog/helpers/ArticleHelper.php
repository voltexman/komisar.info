<?php


namespace blog\helpers;


use backend\models\Article;
use common\models\Comment;
use frontend\models\Favorite;
use frontend\models\Like;
use frontend\models\Viewed;
use Yii;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\StringHelper;

class ArticleHelper
{
    public static function getArticleUrl(string $alias): string
    {
        $baseUrl = Yii::$app->request->hostInfo;
        $fullUrl = $baseUrl . '/blog/' . $alias;

        return Html::a($fullUrl, $fullUrl, ['target' => '_blank']);
    }

    public static function getSymbolsCount(string $text): string
    {
        return iconv_strlen($text) . ' букв';
    }

    public static function getWordsCount(string $text): string
    {
        return str_word_count($text) . ' слов';
    }

    public static function getImagesCount(string $text): int
    {
        $needle = '<img';

        return mb_substr_count($text, $needle);
    }

    protected static function getAccordionImagesCount($id): int
    {
        $article = Article::findOne($id);
        $images = $article->getImages();

        return count($images);
    }

    public static function hasAccordion(int $id): string
    {
        $imagesCount = self::getAccordionImagesCount($id);

        return $imagesCount > 1 ? $imagesCount . ' шт.' : ' Нету';
    }

    public static function getPublicArticleCount(): int
    {
        return Article::find()
            ->where(['publication' => Article::PUBLICATION_ON])
            ->count();
    }

    public static function getIndexationArticleCount(): int
    {
        return Article::find()
            ->where(['indexation' => Article::INDEXATION_ON])
            ->count();
    }

    public static function getCommentsCountById($id): int
    {
        return Article::findOne($id)->getComments()->count();
    }

    public static function getTotalCommentsCount(): int
    {
        return Comment::find()->count();
    }

    public static function inFavorite($id)
    {
        $ipAddress = Yii::$app->request->userIP;

        return Favorite::find()
            ->where(['ip_address' => $ipAddress])
            ->andWhere(['article_id' => $id])
            ->one();
    }

    public static function hasFavorite()
    {
        $ipAddress = Yii::$app->request->userIP;

        return Favorite::find()
            ->where(['ip_address' => $ipAddress])
            ->one();
    }

    public static function favoriteCount(): int
    {
        $ipAddress = Yii::$app->request->userIP;

        return Favorite::find()
            ->where(['ip_address' => $ipAddress])
            ->count();
    }

    public static function hasLike($id)
    {
        $ipAddress = Yii::$app->request->userIP;

        return Like::find()
            ->where(['ip_address' => $ipAddress])
            ->andWhere(['article_id' => $id])
            ->one();
    }

    public static function likeCount($id): int
    {
        $ipAddress = Yii::$app->request->userIP;

        return Like::find()
            ->where(['article_id' => $id])
            ->count();
    }

    public static function getViewedCount($id): int
    {
        return Viewed::find()->where(['article_id' => $id])->count();
    }

    public static function getArticleTags($tags)
    {
        return Json::decode($tags);
    }

    public static function getActualTags($tagsCount): array
    {
        $jsonTags = Article::find()
            ->select('tags')
            ->where(['publication' => Article::PUBLICATION_ON])
            ->orderBy(['id' => SORT_DESC])
            ->limit(10)
            ->asArray()
            ->column();
        $result = [];

        foreach ($jsonTags as $tag) {
            $articleTags = Json::decode($tag);
            $array[] = $articleTags;
        }

        array_walk_recursive($array, function ($item, $key) use (&$result) {
            !empty($item) ? $result[] = $item : null;
        });

        return array_slice($result, false, $tagsCount);
    }

    public static function isViewed($alias): bool
    {
        $ipAddress = Yii::$app->request->userIP;
        $id = Article::findOne(['alias' => $alias])->id;

        $viewed = Viewed::find()
            ->where(['ip_address' => $ipAddress])
            ->andWhere(['article_id' => $id])
            ->one();

        return $viewed ? true : false;
    }

    public static function setViewed($alias)
    {
        $id = Article::findOne(['alias' => $alias])->id;

        $viewed = new Viewed();
        $viewed->article_id = $id;
        $viewed->save();
    }

    public static function getArticleStatus($alias): string
    {
        $status = '';
        $class = '';
        $viewed = true;
        $i = 0;

        self::isViewed($alias) ? $status = 'Прочитано' : $viewed = false;

        if ($viewed === false) {
            $tags = Article::findOne(['alias' => $alias])->tags;
            $tags = self::getArticleTags($tags);
            $tags = array_slice($tags, false, 5);
            foreach ($tags as $tag) {
                $class = match ($i) {
                    0 => 'info',
                    1 => 'success',
                    2 => 'danger',
                    3 => 'warning',
                    4 => 'primary'
                };
                $status .= '<span class="post-cat text-' . $class . '">#' . $tag . '</span>';

                $i++;
            }
        }

        $icon = $viewed ? '<i class="elegant-icon icon_check_alt"></i> ' : null;

        $result = '<span class="post-cat text-' . $class . '">' . $icon . $status . '</span>';

        return $result;
    }

    public static function plural(int $number, array $words): string
    {
        return $words[($number % 100 > 4 && $number % 100 < 20) ? 2 : [2, 0, 1, 1, 1, 2][min($number % 10, 5)]];
    }

    public static function getFirstSymbolByName($name): string
    {
        return mb_strtoupper(mb_substr($name,0,1), 'UTF-8');
    }

    public static function getPageNameByAlias($alias)
    {
        return Article::findOne(['alias' => $alias]) ? Article::findOne(['alias' => $alias])->name : false;
    }
}
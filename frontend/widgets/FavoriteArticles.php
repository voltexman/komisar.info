<?php


namespace frontend\widgets;


use backend\models\Article;
use frontend\models\Favorite;
use Yii;
use yii\base\Widget;
use yii\data\ActiveDataProvider;

class FavoriteArticles extends Widget
{
    public function run()
    {
        $ipAddress = Yii::$app->request->userIP;
        $favoriteIds = Favorite::find()
            ->select('article_id')
            ->where(['ip_address' => $ipAddress])
            ->asArray()
            ->column();

        $dataProvider = new ActiveDataProvider([
            'query' => Article::find()
                ->where(['publication' => Article::PUBLICATION_ON])
                ->andWhere(['id' => $favoriteIds])
                ->orderBy(['id' => SORT_DESC])
                ->limit(2),
            'pagination' => false,
        ]);

        return $favoriteIds ? $this->render('favorite-article', ['dataProvider' => $dataProvider]) : null;
    }
}
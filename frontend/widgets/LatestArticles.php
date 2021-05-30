<?php


namespace frontend\widgets;


use backend\models\Article;
use yii\base\Widget;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;

class LatestArticles extends Widget
{
    public function run(): string
    {
        $alias = substr(Url::current(), 1);

        $dataProvider = new ActiveDataProvider([
            'query' => Article::find()
                ->where(['publication' => Article::PUBLICATION_ON])
                ->andWhere(['not in', 'alias', $alias])
                ->orderBy(['id' => SORT_DESC])
                ->limit(2),
            'pagination' => false
        ]);

        return $this->render('latest-articles', ['dataProvider' => $dataProvider]);
    }
}